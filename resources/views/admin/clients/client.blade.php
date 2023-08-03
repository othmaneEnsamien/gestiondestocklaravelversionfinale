@extends('layouts.appdash')

@section('content')
    <div class="card special-margin">
        <div class="card-header d-flex align-items-center">
            <h4>Gestion des clients</h4>
            <button data-toggle="modal" data-target="#add_modal" class="btn btn-success ml-2"><i
                    class="fa fa-plus"></i></button>
        </div>

        <div class="card m-4">
            <div class="table-responsive">
                <table class="table ">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>id</th>
                            <th>client</th>
                            <th>telephone</th>
                            {{-- <th>numero de commande</th>
                            <th>type de commande</th>
                            <th>etat</th>
                            <th>action</th> --}}


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->nomclient }}</td>
                                <td>{{ $client->telephone }}</td>

                                {{-- <td>
                                            {{ $commande->type_commande }}
                                        </td>
                                        <td>
                                            @if ($commande->etat == 'livre')
                                                <div class="badge badge-success">Livré</div>
                                            @else
                                                <div class="badge badge-warning">En attente</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary open-detail-modal" data-toggle="modal"
                                                data-target="#detailModal"
                                                data-details="{{ json_encode($commande->produits) }}">Détail</a>
                                            @if ($commande->etat == 'en attente')
                                                <button class="btn btn-success mark-as-delivered"
                                                    data-commande-id="{{ $commande->id }}">Livré</button>
                                            @endif
                                        </td> --}}
                            </tr>



                            <!-- Fin du modal de modification -->
                        @endforeach
                    </tbody>

                </table>

            </div>



        </div>
        <div class="pagination m-2">
            {{ $clients->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
    <!-- Modal des détails de la commande -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Détails de la commande</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <div class="modal-body">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Produit</th>
                              <th>Image</th>
                              <th>Prix unitaire</th>
                              <th>Quantité commandée</th>
                              <th>Prix total</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($commande->produits as $produit)
                              <tr>
                                  <td>{{ $produit->nomproduit }}</td>
                                  <td><img src="{{ asset('storage/' . $produit->Image) }}"
                                          alt="{{ $produit->nomproduit }}" width="100"></td>
                                  <td>{{ $produit->Prix }}</td>
                                  <td>{{ $produit->pivot->quantite }}</td>
                                  <td>{{ $produit->Prix * $produit->pivot->quantite }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>

              </div> --}}
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Image</th>
                                <th>Prix unitaire</th>
                                <th>Quantité commandée</th>
                                <th>Prix total</th>
                            </tr>
                        </thead>
                        <tbody id="productDetailsBody">
                            <!-- Les détails des produits seront ajoutés ici dynamiquement -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.mark-as-delivered').click(function(e) {
                e.preventDefault();
                var commandeId = $(this).data('commande-id');

                // Envoyez une requête AJAX pour mettre à jour l'état de la commande
                $.ajax({
                    url: '/commande/update-etat',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        commandeId: commandeId
                    },
                    success: function(response) {
                        // Mettez à jour l'état de la commande dans la vue
                        if (response.success) {
                            // Changez l'état de la commande dans la vue
                            var badge = $('.mark-as-delivered[data-commande-id="' + commandeId +
                                '"]');
                            badge.removeClass('btn-success').addClass('btn-secondary').text(
                                'Livré');

                            // Masquer le bouton "Livré"
                            badge.remove();
                        }
                    },
                    error: function(xhr) {
                        // Gérez les erreurs de la requête AJAX
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
@endpush
