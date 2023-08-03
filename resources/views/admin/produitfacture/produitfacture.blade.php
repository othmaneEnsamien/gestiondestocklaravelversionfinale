@extends('layouts.appdash')

@section('content')
    <style>
        .special-margin {
            margin: 20px;
        }
    </style>
    <div class="section " style="z-index:1;">
        <div class="row">
            <div class="col-12">
                <div class="card special-margin">
                    <div class="card-header"></div>
                    <div class="card-header d-flex">
                        <h4>Gestion Factures Produits</h4>
                        <button data-toggle="modal" data-target="#typeFactureModal" title=" Add produitfacture"
                            class="btn btn-success ml-2">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body">
                        {{-- <button type="button" class="m-2 btn btn-custom" data-toggle="modal"
                            data-target="#typeFactureModal">
                            Ajouter Produit
                        </button> --}}

                        @if ($produits->count() > 0)
                            <div class="mt-3 table-responsive">
                                <table class="table">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>Nom du produit</th>
                                            <th>Prix</th>
                                            <th>Mesure</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produits as $produit)
                                            <tr>
                                                <td>{{ $produit->nomproduit }}</td>
                                                <td>{{ $produit->Prix }}</td>
                                                <td>{{ $produit->pivot->Quantite }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Aucun produit associé à cette facture.</p>
                        @endif

                    </div>
                </div>

                <!-- Type de Facture Modal -->
                <div class="modal fade" id="typeFactureModal" tabindex="-1" role="dialog"
                    aria-labelledby="typeFactureModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="typeFactureModalLabel">Sélectionner le type de facture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="type_facture">Type de facture</label>
                                    <select class="form-control" id="type_facture" name="type_facture"
                                        onchange="toggleFormFields(this.value)">
                                        <option value="">Sélectionnez le type de facture</option>
                                        <option value="existant">Produit existant</option>
                                        <option value="nouveau">Nouveau produit</option>
                                    </select>
                                </div>

                                <!-- Champs pour le produit existant -->
                                <div id="champs_produit_existant" style="display: none;">
                                    <form method="POST"
                                        action="{{ route('factures.ajouter-produit', ['idFacture' => $facture->id]) }}">
                                        {{-- action="{{ route('factures.ajouter-produit', ['idFacture' => $facture->id]) }}"> --}}
                                        @csrf
                                        <input type="hidden" name="type_facture" value="existant">
                                        <div class="form-group">
                                            <label for="produit_existant">Produit existant</label>
                                            <select class="form-control" id="produit_existant" name="produit_existant">
                                                <!-- Options pour les produits existants -->
                                                <option value=""></option>
                                                @foreach ($allproduits as $produit)
                                                    <option value="{{ $produit->id }}">{{ $produit->nomproduit }}</option>
                                                @endforeach
                                                <!-- ... -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="mesure">Mesure</label>
                                            <input type="text" class="form-control @error('mesure') is-invalid @enderror"
                                                id="mesure" name="mesure" value="{{ old('mesure') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mesure">prix unitaire</label>
                                            <input type="text" class="form-control @error('Prix') is-invalid @enderror"
                                                id="Prix" name="Prix" value="{{ old('Prix') }}" required>
                                        </div>


                                        {{-- <div class="form-group">
                                            <label for="prix">Prix</label>
                                            <input type="number" step="0.01" class="form-control" id="Prix"
                                                name="Prix" value="{{ old('Prix') }}" required>
                                        </div> --}}

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Champs pour le nouveau produit -->
                                <div id="champs_nouveau_produit" style="display: none;">
                                    <form method="POST"
                                        action="{{ route('factures.ajouter-produit', ['idFacture' => $facture->id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="type_facture" value="nouveau">
                                        <div class="form-group">
                                            <label for="nomproduit">Nom du produit</label>
                                            <input type="text"
                                                class="form-control @error('nomproduit') is-invalid @enderror"
                                                id="nomproduit" name="nomproduit" value="{{ old('nomproduit') }}" required>
                                            @error('nomproduit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                rows="4" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="Prix">Prix</label>
                                            <input type="number" step="0.01"
                                                class="form-control @error('Prix') is-invalid @enderror" id="Prix"
                                                name="Prix" value="{{ old('Prix') }}" required>
                                            @error('Prix')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file"
                                                class="form-control-file @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*" required>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mesure">Mesure</label>
                                            <input type="text"
                                                class="form-control @error('mesure') is-invalid @enderror" id="mesure"
                                                name="mesure" value="{{ old('mesure') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="id_categorie">Catégorie</label>
                                            <select class="form-control" id="id_categorie" name="id_categorie"
                                                onchange="loadSousCategories(this.value)">
                                                <option value="">Sélectionnez une catégorie</option>
                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="id_souscategorie">Sous-catégorie</label>
                                            <select class="form-control" id="id_souscategorie_add"
                                                name="id_souscategorie" required disabled>
                                                <option value="">Sélectionnez une catégorie d'abord</option>
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
<script>
    function loadSousCategories(categorieId) {
        var sousCategorieSelect = $('#id_souscategorie_add'); // Changed to id_souscategorie_add
        sousCategorieSelect.html('<option value="">Chargement...</option>');

        // Effectuez une requête Ajax pour récupérer les sous-catégories associées à la catégorie sélectionnée
        $.ajax({
            url: '/souscategories/' + categorieId,
            type: 'GET',
            success: function(response) {
                sousCategorieSelect.html('');
                response.forEach(function(sousCategorie) {
                    sousCategorieSelect.append('<option value="' + sousCategorie.id + '">' +
                        sousCategorie.nom_souscategorie + '</option>');
                });
                sousCategorieSelect.prop('disabled', false);
            },
            error: function() {
                sousCategorieSelect.html('<option value="">Erreur lors du chargement</option>');
                sousCategorieSelect.prop('disabled', true);
            }
        });
    }
</script>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#addProductModal').on('hidden.bs.modal', function() {
                // Reset the form when the modal is closed
                $(this).find('form').trigger('reset');
            });

            $('form').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle the success response

                        // Close the modal
                        $('#addProductModal').modal('hide');

                        // Create a new row in the table to display the added product
                        var newRow = $('<tr>');

                        newRow.append($('<td>').text(response.nomproduit));
                        newRow.append($('<td>').text(response.description));
                        newRow.append($('<td>').text(response.Prix));
                        newRow.append($('<td>').text(response.Mesure));
                        newRow.append($('<td>').text(response.categorie));
                        newRow.append($('<td>').text(response.souscategorie));
                        newRow.append($('<td>').text(response.created_at));

                        $('#productsTable tbody').append(newRow);
                        toastr.success('Le produit a été ajouté avec succès.');
                    },
                    handleSuccessUpdate();
                    error: function() {
                        toastr.success('Le produit est non ajoute .');
                    }
                });
            });
        });

        function handleSuccessUpdate() {
            // Reload the current page
            location.reload();
        }

        // Handle the click event on the "Edit Product" button
        $(document).on('click', '.edit-product-btn', function() {
            var productId = $(this).data('id');

            // Make an Ajax request to get the product details
            $.ajax({
                url: '/produits/' + productId + '/edit', // Replace '/produits' with your edit product route
                type: 'GET',
                success: function(response) {
                    // Populate the form fields with the product details
                    $('#edit-nomproduit').val(response.nomproduit);
                    $('#edit-description').val(response.description);
                    $('#edit-Prix').val(response.Prix);
                    $('#edit-mesure').val(response.mesure);
                    $('#edit-id_categorie').val(response.id_categorie);

                    // Load the related sub-categories based on the selected category
                    loadEditSousCategories(response.id_categorie, response.id_souscategorie);

                    // Set the form action URL to the product update route
                    $('#editProductForm').attr('action', '/produits/' +
                        productId); // Replace '/produits' with your update product route

                    // Show the "Edit Product" modal
                    $('#editProductModal').modal('show');
                },
                error: function() {
                    // Handle the error response
                }
            });
        });

        // Function to load the sub-categories in the "Edit Product" modal
        function loadEditSousCategories(categorieId, selectedSousCategorieId) {
            var sousCategorieSelect = $('#edit-id_souscategorie');
            sousCategorieSelect.html('<option value="">Chargement...</option>');

            // Make an Ajax request to get the sub-categories associated with the selected category
            $.ajax({
                url: '/souscategories/' +
                    categorieId, // Replace '/souscategories' with your URL to retrieve sub-categories
                type: 'GET',
                success: function(response) {
                    // Remove the loading option
                    sousCategorieSelect.html('');

                    // Add the retrieved sub-category options
                    response.forEach(function(sousCategorie) {
                        var option = $('<option>').val(sousCategorie.id).text(sousCategorie
                            .nom_souscategorie);

                        // Set the selected option if it matches the previously selected sub-category
                        if (sousCategorie.id === selectedSousCategorieId) {
                            option.attr('selected', true);
                        }

                        sousCategorieSelect.append(option);
                    });

                    // Enable the sub-category select field
                    sousCategorieSelect.prop('disabled', false);
                },
                error: function() {
                    // Handle the Ajax request error
                    sousCategorieSelect.html('<option value="">Erreur lors du chargement</option>');
                }
            });
        }
    </script>
@endpush
