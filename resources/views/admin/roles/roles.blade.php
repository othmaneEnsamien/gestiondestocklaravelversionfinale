@extends('layouts.appdash')

@section('content')
    <style>
        .special-margin {
            margin: 20px;
        }
    </style>
    <div class="section m-2 " style="z-index:1;">
        <div class="row">
            <div class="col-12">
                <div class="card special-margin ">
                    <div class="card-header d-flex align-items-center">
                        <h4>Gestion des rôles</h4>
                        <button data-toggle="modal" data-target="#add_modal" class="btn btn-success ml-2"><i
                                class="fa fa-plus"></i></button>
                    </div>
                    <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add_modalLabel">Ajouter un produit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form style="margin: 30px" action="{{ route('roles.store') }}" method="POST"
                                        id="roleForm">
                                        @csrf

                                        <div class="form-group">
                                            <label for="name">Nom du rôle</label>
                                            <input type="text" style="width:200px" name="name" class="form-control"
                                                required>
                                        </div>

                                        <div>
                                            <h6 style="font-weight: bold">Permissions existantes</h6>
                                        </div>

                                        <div class="form-group">
                                            {{-- <label style="margin-right:15px" for="permissions"></label> --}}
                                            <select style="width: 200px" name="permissions[]" data-tags="true"
                                                class="form-control select2" multiple>
                                                @foreach ($permissions as $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <button style="width: 100px" type="submit"
                                                class="btn btn-primary">Créer</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card m-4">
                        <table class="table ">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Rôle</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-custom" data-toggle="modal"
                                                data-target="#permissionsModal{{ $role->id }}">Afficher les
                                                permissions</button>

                                            <!-- Permissions Modal -->
                                            <div class="modal fade" id="permissionsModal{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="permissionsModalLabel{{ $role->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="permissionsModalLabel{{ $role->id }}">Liste des
                                                                permissions</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-wrap">
                                                                @foreach ($role->permissions as $permission)
                                                                    <div class="permission-item">
                                                                        <i class="fa fa-check-circle text-success"></i>
                                                                        <span>{{ $permission->name }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-success btn-sm mr-2"
                                                    data-toggle="modal"
                                                    data-target="#editRoleModal{{ $role->id }}">Modifier</button>

                                                <!-- Edit Role Modal -->
                                                <div class="modal fade" id="editRoleModal{{ $role->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="editRoleModalLabel{{ $role->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editRoleModalLabel{{ $role->id }}">Modifier
                                                                    le
                                                                    rôle</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($errors->any())
                                                                    <div class="alert alert-danger">
                                                                        <ul>
                                                                            @foreach ($errors->all() as $error)
                                                                                <li>{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif

                                                                @if (session('success'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('success') }}
                                                                    </div>
                                                                @endif

                                                                <form action="{{ route('roles.update', $role->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="form-group">
                                                                        <label for="name">Nom du rôle</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control"
                                                                            value="{{ $role->name }}" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Permissions</label>
                                                                        <div class="list-group"
                                                                            style="max-height: 200px; overflow-y: auto;">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="select-all-checkbox">
                                                                                <label class="form-check-label"
                                                                                    for="select-all-checkbox">Sélectionner/Désélectionner
                                                                                    tous</label>
                                                                            </div>
                                                                            @foreach ($permissions as $permission)
                                                                                <div class="list-group-item">
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="form-check-input permission-checkbox"
                                                                                            type="checkbox"
                                                                                            name="permissions[]"
                                                                                            value="{{ $permission->id }}"
                                                                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                                        <label
                                                                                            class="form-check-label">{{ $permission->name }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">Enregistrer</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteRoleModal{{ $role->id }}">Supprimer</button>

                                                <!-- Delete Role Modal -->
                                                <div class="modal fade" id="deleteRoleModal{{ $role->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="deleteRoleModalLabel{{ $role->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteRoleModalLabel{{ $role->id }}">
                                                                    Supprimer
                                                                    le rôle</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Êtes-vous sûr de vouloir supprimer le rôle
                                                                "{{ $role->name }}" ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Annuler</button>
                                                                <form action="{{ route('roles.destroy', $role->id) }}"
                                                                    method="POST" style="display: inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="pagination m-2">
                        {{ $roles->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Sélectionner/Désélectionner tous les permissions
        const selectAllCheckbox = document.querySelector('#select-all-checkbox');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    </script>
    <script>
        // Afficher le formulaire de permission existante
        document.getElementById('useExistingPermission').addEventListener('click', function() {
            document.getElementById('existingPermissionForm').style.display = 'block';
            document.getElementById('newPermissionForm').style.display = 'none';
        });

        // Afficher le formulaire de nouvelle permission
        document.getElementById('createNewPermission').addEventListener('click', function() {
            document.getElementById('existingPermissionForm').style.display = 'none';
            document.getElementById('newPermissionForm').style.display = 'block';
        });
    </script>
@endpush
