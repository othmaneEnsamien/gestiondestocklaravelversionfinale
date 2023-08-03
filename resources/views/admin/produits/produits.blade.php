@extends('layouts.appdash')

@section('content')
    <style>
        .special-margin {
            margin: 20px;
        }
    </style>
    <div class="card special-margin">
        <div class="card-header d-flex">
            <h4>Gestion Produit</h4>
            <button data-toggle="modal" data-target="#addProductModal" title="Ajouter Produit" class="btn btn-success ml-2">
                <i class="fa fa-plus"></i>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="productsTable" class="table dataTable no-footer">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th class="sorting_desc" tabindex="0" aria-sort="descending"
                                aria-label="Produit: activer pour trier la colonne par ordre croissant">Produit</th>
                            <th class="sorting_desc" tabindex="0" aria-sort="descending"
                                aria-label="Produit: activer pour trier la colonne par ordre croissant">Image</th>
                            <th class="sorting" tabindex="0"
                                aria-label="Qte/Unité: activer pour trier la colonne par ordre croissant">Mesure</th>
                            <th class="sorting" tabindex="0"
                                aria-label="Qte/Unité: activer pour trier la colonne par ordre croissant">description</th>
                            <th class="sorting" tabindex="0"
                                aria-label="Prix: activer pour trier la colonne par ordre croissant">Prix</th>
                            <th class="sorting" tabindex="0"
                                aria-label="Prix: activer pour trier la colonne par ordre croissant">Categorie</th>
                            <th class="sorting" tabindex="0"
                                aria-label="Sous catégorie: activer pour trier la colonne par ordre croissant">Sous
                                catégorie</th>
                            <th class="sorting_disabled" aria-label="Action">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($produits as $produit)
                            <tr>
                                <td class="sorting_1">{{ $produit->nomproduit }}</td>
                                <td><img src="{{ asset('storage/' . $produit->Image) }}" alt="Image du produit"
                                        width="50" height="50"></td>

                                <td>{{ $produit->mesure }}</td>
                                <td>{{ $produit->description }}</td>
                                <td>{{ $produit->Prix }}</td>
                                <td>{{ $produit->categorie->nom_categorie }}</td>
                                <td>{{ $produit->souscategorie ? $produit->souscategorie->nom_souscategorie : '-' }}
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#editProductModal{{ $produit->id }}"
                                        title="modifier Produit" class="btn btn-success edit-product-btn">
                                        modifier
                                    </button>
                                    @if (isset($produit))
                                        <!-- Edit Product Modal -->
                                        <div class="modal fade" id="editProductModal{{ $produit->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editProductModalLabel">Modifier un
                                                            produit</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('produits.update', isset($produit) ? $produit->id : '') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label for="nomproduit">Nom du produit:</label>
                                                                <input type="text" name="nomproduit" id="nomproduit"
                                                                    value="{{ $produit->nomproduit }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="prix">Prix:</label>
                                                                <input type="number" name="prix" id="prix"
                                                                    value="{{ $produit->Prix }}" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mesure">Mesure:</label>
                                                                <input type="text" name="mesure" id="mesure"
                                                                    value="{{ $produit->mesure }}" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="image">Image:</label>
                                                                <input type="file" name="image" id="image"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="id_categorie">Catégorie:</label>
                                                                <select name="id_categorie" id="id_categorie"
                                                                    class="form-control"
                                                                    onchange="loadEditSousCategories(this.value)" required>
                                                                    @foreach ($categories as $categorie)
                                                                        <option value="{{ $categorie->id }}"
                                                                            {{ $produit->id_categorie == $categorie->id ? 'selected' : '' }}>
                                                                            {{ $categorie->nom_categorie }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="id_souscategorie">Sous-catégorie</label>
                                                                <select class="form-control" id="id_souscategorie_edit"
                                                                    name="id_souscategorie" required>
                                                                    <option value="0">Sélectionnez une catégorie
                                                                        d'abord</option>
                                                                </select>
                                                            </div>

                                                            {{-- <div class="form-group">
                                                                <label for="id_souscategorie">Sous-catégorie:</label>
                                                                <select name="id_souscategorie" id="id_souscategorie"
                                                                    class="form-control">
                                                                    @foreach ($souscategories as $souscategorie)
                                                                        <option value="{{ $souscategorie->id }}"
                                                                            {{ $produit->id_souscategorie == $souscategorie->id ? 'selected' : '' }}>
                                                                            {{ $souscategorie->nom_souscategorie }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div> --}}


                                                            <div class="form-group">
                                                                <label for="description">Description:</label>
                                                                <textarea name="description" id="description" class="form-control">{{ $produit->description }}</textarea>
                                                            </div>

                                                            <button type="submit"
                                                                class="btn btn-primary">Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="pagination">
                    {{ $produits->links('vendor.pagination.bootstrap-4') }}
                </div>
                <div id="productsTable_processing" class="dataTables_processing card" style="display: none;">
                    Traitement...
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Ajouter un produit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nomproduit">Nom du produit</label>
                            <input type="text" class="form-control @error('nomproduit') is-invalid @enderror"
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
                            <input type="number" step="0.01" class="form-control @error('Prix') is-invalid @enderror"
                                id="Prix" name="Prix" value="{{ old('Prix') }}" required>
                            @error('Prix')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                id="image" name="image" accept="image/*" required>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mesure">Mesure</label>
                            <input type="text" class="form-control @error('mesure') is-invalid @enderror"
                                id="mesure" name="mesure" value="{{ old('mesure') }}" required>
                        </div>


                        <div class="form-group">
                            <label for="id_categorie">Catégorie</label>
                            <select class="form-control" id="id_categorie" name="id_categorie"
                                onchange="loadSousCategories(this.value)">
                                <option value="">Sélectionnez une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_souscategorie">Sous-catégorie</label>
                            <select class="form-control" id="id_souscategorie_add" name="id_souscategorie" required
                                disabled>
                                <option value="">Sélectionnez une catégorie d'abord</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="id_souscategorie">Sous-catégorie:</label>
                            <select name="id_souscategorie" id="id_souscategorie" class="form-control">
                                @foreach ($souscategories as $souscategorie)
                                    <option value="{{ $souscategorie->id }}"
                                        {{ $produit->id_souscategorie == $souscategorie->id ? 'selected' : '' }}>
                                        {{ $souscategorie->nom_souscategorie }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @if (isset($produit))
        <!-- Edit Product Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Modifier un produit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produits.update', isset($produit) ? $produit->id : '') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nomproduit">Nom du produit:</label>
                                <input type="text" name="nomproduit" id="nomproduit"
                                    value="{{ $produit->nomproduit }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="prix">Prix:</label>
                                <input type="number" name="prix" id="prix" value="{{ $produit->Prix }}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="mesure">Mesure:</label>
                                <input type="text" name="mesure" id="mesure" value="{{ $produit->mesure }}"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="id_categorie">Catégorie</label>
                                <select class="form-control" id="id_categorie" name="id_categorie"
                                    onchange="loadEditSousCategories(this.value)" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="id_souscategorie">Sous-catégorie</label>
                                <select class="form-control" id="id_souscategorie" name="id_souscategorie" required>
                                    <option value="">Sélectionnez une catégorie d'abord</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_souscategorie">Sous-catégorie:</label>
                                <select name="id_souscategorie" id="id_souscategorie" class="form-control">
                                    @foreach ($souscategories as $souscategorie)
                                        <option value="{{ $souscategorie->id }}"
                                            {{ $produit->id_souscategorie == $souscategorie->id ? 'selected' : '' }}>
                                            {{ $souscategorie->nom_souscategorie }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ $produit->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
@endsection
<script>
    // You can use the same function for loading subcategories in the edit modal as well
    function loadEditSousCategories(categorieId) {
        var sousCategorieSelect = $('#id_souscategorie_edit');
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
            var table = $('#productsTable').DataTable({
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
        function handleSuccessUpdate() {
            // Reload the current page
            location.reload();
        }

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
                        // Handle the error response
                    }
                });
            });
        });

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
                    $('#editProductModal').modal('hide');

                },
                handleSuccessUpdate();
                error: function() {
                    // Handle the error response
                }
            });
        });
    </script>
@endpush
