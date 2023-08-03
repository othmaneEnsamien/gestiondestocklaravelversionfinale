@extends('layouts.appdash')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card m-2">
                        <div class="card-header d-flex ">
                            <h4>Gestion Commande</h4>
                            <button data-toggle="modal" data-target="#add_modal" title="Ajouter Commande"
                                class="btn btn-success ml-2 ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="card m-4">

                            <table class="table" id="CommandeTable" role="grid" aria-describedby="CommandeTable_info"
                                style="width: 100%;">
                                <thead style="background: #ededed;">
                                    <tr role="row">
                                        <th class="sorting_desc" tabindex="0" aria-controls="CommandeTable" rowspan="1"
                                            colspan="1" style="width: 259px;" aria-sort="descending"
                                            aria-label="Client: activer pour trier la colonne par ordre croissant">numero de
                                            commande
                                        </th>
                                        <th class="sorting_desc" tabindex="0" aria-controls="CommandeTable" rowspan="1"
                                            colspan="1" style="width: 259px;" aria-sort="descending"
                                            aria-label="Client: activer pour trier la colonne par ordre croissant">Client
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="CommandeTable" rowspan="1"
                                            colspan="1" style="width: 178px;"
                                            aria-label="Date: activer pour trier la colonne par ordre croissant">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="CommandeTable" rowspan="1"
                                            colspan="1" style="width: 140px;"
                                            aria-label="État: activer pour trier la colonne par ordre croissant">État</th>
                                        <th class="sorting" tabindex="0" aria-controls="CommandeTable" rowspan="1"
                                            colspan="1" style="width: 130px;"
                                            aria-label="Type: activer pour trier la colonne par ordre croissant">Type</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 170px;"
                                            aria-label="Action">Action</th>
                                        <!-- Nouvelle colonne pour afficher le total des produits commandés -->
                                        <th style="width: 120px;" aria-label="Total des produits commandés">Total commandes
                                            produit
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commandes as $commande)
                                        <tr role="row" class="odd">
                                            <td>{{ $commande->numero_commande }}</td>
                                            <td class="sorting_1">{{ $commande->client->nomclient }}</td>
                                            <td>{{ $commande->created_at }}</td>
                                            <td>
                                                @if ($commande->etat == 'livre')
                                                    <div class="badge badge-success">Livré</div>
                                                @else
                                                    <div class="badge badge-warning">En attente</div>
                                                @endif
                                            </td>
                                            <td>{{ $commande->type_commande }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary open-detail-modal"
                                                    data-toggle="modal" data-target="#detailModal"
                                                    data-details="{{ json_encode($commande->produits) }}">Détail</a>
                                                @if ($commande->etat == 'en attente')
                                                    <button class="btn btn-success mark-as-delivered"
                                                        data-commande-id="{{ $commande->id }}">Livré</button>
                                                @endif
                                            </td>
                                            <!-- Afficher le total des produits commandés pour cette commande -->
                                            <td>{{ $totals[$commande->id] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>
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


        <div class="modal fade bd-example-modal-lg" id="add_modal" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModal">Ajouter commande</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="AddCommandeForm" enctype="multipart/form-data" novalidate="novalidate"
                            action="{{ route('commande.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="numero_commande">
                            <div class="col-md-12">
                                <div class="alert" id="AddMessage"></div>
                            </div>

                            <style>
                                fieldset {
                                    border: 2px groove #c3c3c3;
                                    padding: 5px;
                                }
                            </style>

                            <fieldset>
                                <legend>Client:</legend>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type_client">Sélectionnez le type de client :</label>
                                            <select class="form-control" id="type_client" name="type_client"
                                                onchange="toggleFormFieldsCommande(this.value)">
                                                <option value="">Sélectionnez le type de client</option>
                                                <option value="existant">Client existant</option>
                                                <option value="nouveau">Nouveau client</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="champs_client_existant" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="client_existant">Client existant</label>
                                            <select class="form-control" id="client_existant" name="client_existant">
                                                <!-- Options pour les clients existants -->
                                                <option value="">Sélectionnez un client existant</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->nomclient }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row" id="champs_nouveau_client" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nomclient">Nom du client</label>
                                            <input type="text" class="form-control" id="nomclient" name="nomclient"
                                                placeholder="Nom du client">
                                        </div>
                                        <div class="form-group">
                                            <label for="telephone">Téléphone</label>
                                            <input type="text" class="form-control" id="telephone" name="telephone"
                                                placeholder="Téléphone">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Commande:</legend>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Type commande</label>
                                        <select class="form-control" name="type_commande">
                                            <option value="">Choisissez</option>
                                            <option value="livre">a livré</option>
                                            <option value="sur place">sur place</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Catégorie</label>
                                        <select class="form-control" id="listCat" name="categorie">
                                            <option value="">Choisissez</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Sous Catégorie</label>
                                        <select class="form-control" id="listSubCat" name="sub_cat" disabled="">
                                            <option value="0">Choisissez</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Produits</label>
                                        <select class="form-control select2" id="listProduct" name="listProduct[]"
                                            style="width:100% !important" tabindex="-1" aria-hidden="true" multiple>
                                            <option value="0">Choisissez</option>
                                        </select>
                                    </div>


                                    <div class="form-row" id="quantityRow" style="display: none;">
                                        <div class="form-group col-md-6">
                                            <label>Quantité</label>
                                            <input type="number" class="form-control" name="quantite" min="1"
                                                aria-invalid="false">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Quantité disponible :</label>
                                            <span class="quantity-available"></span>
                                        </div>
                                    </div>




                                </div>
                                <div id="ProductsForm"></div>
                            </fieldset>

                            <button type="submit" class="btn btn-success m-t-15 waves-effect">Ajouter</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('#listProduct').on('change', function() {
            var produitId = $(this).val();

            // Faites une requête AJAX pour obtenir la quantité disponible pour le produit sélectionné
            $.ajax({
                url: '/getProductQuantity/' + produitId,
                type: 'GET',
                success: function(response) {
                    // Affichez la quantité disponible à côté du champ de quantité
                    $('.quantity-available').text('Quantité disponible : ' + response.quantity);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#listProduct').select2(); // Initialisez le champ de sélection des produits avec Select2

            // Ajoutez un gestionnaire d'événements pour le champ de sélection des produits
            $('#listProduct').on('select2:select', function(e) {
                var produitId = e.params.data.id;

                // Faites une requête AJAX pour obtenir la quantité disponible pour le produit sélectionné
                $.ajax({
                    url: '/getProductQuantity/' + produitId,
                    type: 'GET',
                    success: function(response) {
                        // Affichez la quantité disponible à côté du champ de quantité
                        $('.quantity-available').text('Quantité disponible : ' + response
                            .quantity);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            var table = $('#CommandeTable').DataTable({
                "order": [
                    [2, "desc"]
                ], // Définissez la colonne de tri par défaut (par exemple, la colonne de la date)
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" // Définissez la langue en français
                }
            });

            // Appliquer la recherche globale
            $('#globalSearch').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>

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
