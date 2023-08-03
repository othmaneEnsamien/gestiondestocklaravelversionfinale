@extends('layouts.appdash')

@section('content')
    <style>
        .special-margin {
            margin: 20px;
        }
    </style>
    <div class="col-12">
        <div class="card special-margin ">
            <div class="card-header">
                <h4>Gestion Facture</h4>
            </div>
            <div class="card-body">
                <form id="AddFactureForm" method="POST" action="{{ route('facture.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="alert" id="AddMessage" style="display: none;"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Fournisseur</label>
                            <input type="text" value="" class="form-control" placeholder="nom de fournisseur"
                                name="fournisseur">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Numéro F.</label>
                            <input type="text" value="" class="form-control" placeholder="numéro de facture"
                                name="numero_facture">
                            @error('numero_facture')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>Date F.</label>
                            <input type="date" value="" class="form-control" placeholder="numéro de facture"
                                name="date_facture">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Prix HT</label>
                            <input type="text" value="" class="form-control" placeholder="prix HT" name="prix_ht"
                                id="prix_ht">
                        </div>

                        <div class="form-group col-md-4">
                            <label>TVA</label>
                            <input type="text" value="" class="form-control" placeholder="TVA" name="tva"
                                id="tva">
                        </div>


                        <div class="form-group col-md-4">
                            <label>Prix TTC</label>
                            <input type="text" value="" class="form-control" placeholder="prix TTC" name="prix_ttc"
                                id="prix_ttc_calculated" readonly>
                        </div>

                    </div>

                    <button type="submit" id="btnFacture" class="btn btn-success m-t-15 waves-effect">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12" id="productList-test">
        <div class="card">
            <div class="card-header">
                <h4>Factures</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="FactureTable" role="grid"
                        aria-describedby="FactureTable_info" style="width: 1323px;">
                        <thead style="background: #ededed;">
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="FactureTable" rowspan="1"
                                    colspan="1" style="width: 281px;"
                                    aria-label="N. facture: activer pour trier la colonne par ordre croissant">N. facture
                                </th>
                                <th class="sorting_desc" tabindex="0" aria-controls="FactureTable" rowspan="1"
                                    colspan="1" style="width: 215px;" aria-sort="descending"
                                    aria-label="Date: activer pour trier la colonne par ordre croissant">Date</th>
                                <th class="sorting" tabindex="0" aria-controls="FactureTable" rowspan="1"
                                    colspan="1" style="width: 313px;"
                                    aria-label="Fournisseur: activer pour trier la colonne par ordre croissant">Fournisseur
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 364px;"
                                    aria-label="Action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factures as $facture)
                                <tr role="row">
                                    <td>{{ $facture->Num_Facture }}</td>
                                    <td>{{ $facture->Date }}</td>
                                    <td>{{ $facture->nomFournisseur }}</td>
                                    <td>
                                        <a href="{{ route('facture.ajouterProduits', ['facture' => $facture->id]) }}"
                                            class="btn btn-primary">Ajouter produits</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var prixHTInput = document.getElementById('prix_ht');
            var tvaInput = document.getElementById('tva');
            var prixTTCOutput = document.getElementById('prix_ttc_calculated');

            prixHTInput.addEventListener('input', calculatePrixTTC);
            tvaInput.addEventListener('input', calculatePrixTTC);

            function calculatePrixTTC() {
                var prixHT = parseFloat(prixHTInput.value);
                var tva = parseFloat(tvaInput.value);

                if (!isNaN(prixHT) && !isNaN(tva)) {
                    var prixTTC = prixHT + (prixHT * tva / 100);
                    prixTTCOutput.value = prixTTC.toFixed(2);
                } else {
                    prixTTCOutput.value = '';
                }
            }
        });
    </script>
@endpush
