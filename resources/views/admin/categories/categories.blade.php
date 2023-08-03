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
                    <div class="card-header d-flex">
                        <h4>Gestion Produit</h4>
                        <button data-toggle="modal" data-target="#categoryModal" title=" Add Category"
                            class="btn btn-success ml-2">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">


                        <!-- Modal for adding a category -->
                        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                            aria-labelledby="categoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('categories.store') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nom_categorie">Category Name</label>
                                                <input type="text" class="form-control" id="nom_categorie"
                                                    name="nom_categorie" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-custom"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-custom">Save Category</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <table class="table ">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>id</th>
                                        <th>categorie</th>
                                        <th>sous categorie</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        @php
                                            $filteredSubCategories = $subCategories->where('id_categorie', $category->id);
                                        @endphp
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->nom_categorie }}</td>
                                            <td>
                                                @if ($subCategories->where('id_categorie', $category->id)->count() > 0)
                                                    <select class="form-control">
                                                        @foreach ($filteredSubCategories as $subCategory)
                                                            <option value="{{ $subCategory->id }}">
                                                                {{ $subCategory->nom_souscategorie }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    No subcategory added.
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-custom" data-toggle="modal"
                                                    data-target="#subCategoryModal{{ $category->id }}">
                                                    Add Subcategory
                                                </button>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#detachSubCategoryModal{{ $category->id }}">
                                                    Detach Subcategory
                                                </button>


                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDeleteCategory('{{ $category->id }}')">
                                                    Supprimer la catégorie
                                                </button>





                                                <!-- Modal for adding a subcategory -->
                                                <div class="modal fade" id="subCategoryModal{{ $category->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="subCategoryModalLabel{{ $category->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST"
                                                                action="{{ route('subcategories.store') }}">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="subCategoryModalLabel{{ $category->id }}">Add
                                                                        Subcategory</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="id_categorie">Category</label>
                                                                        <select class="form-control" id="id_categorie"
                                                                            name="id_categorie" required>
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->nom_categorie }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nom_souscategorie">Subcategory
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nom_souscategorie" name="nom_souscategorie"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Subcategory</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal for deleting a category -->
                                                <div class="modal fade" id="deleteCategoryModal{{ $category->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteCategoryModalLabel{{ $category->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form id="deleteCategoryForm{{ $category->id }}"
                                                                method="POST"
                                                                action="{{ route('categories.destroy', ['id' => $category->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteCategoryModalLabel{{ $category->id }}">
                                                                        Supprimer la catégorie</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?
                                                                        Cette action est irréversible.</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Annuler</button>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="confirmDeleteCategory('{{ $category->id }}')">Supprimer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Modal for detaching a subcategory -->
                                                <div class="modal fade" id="detachSubCategoryModal{{ $category->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="detachSubCategoryModalLabel{{ $category->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST"
                                                                action="{{ route('categories.subcategories.detach', ['categoryId' => $category->id]) }}">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="detachSubCategoryModalLabel{{ $category->id }}">
                                                                        Detach
                                                                        Subcategory</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Select the subcategories to detach from this
                                                                        category:
                                                                    </p>
                                                                    <div class="form-group">
                                                                        <label for="subcategories">Subcategories</label>
                                                                        <select class="form-control" id="subcategories"
                                                                            name="subcategories[]" multiple required>
                                                                            @foreach ($filteredSubCategories as $subCategory)
                                                                                <option value="{{ $subCategory->id }}">
                                                                                    {{ $subCategory->nom_souscategorie }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Detach</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function confirmDeleteCategory(categoryId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?")) {
                // Soumettre le formulaire de suppression de la catégorie
                document.getElementById('deleteCategoryForm' + categoryId).submit();
            }
        }
    </script>
@endpush
