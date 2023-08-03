@extends('layouts.appdash')

@section('content')
    <style>
        .special-margin {
            margin: 20px;
        }
    </style>
    <div class="card special-margin">
        <div class="card-header d-flex align-items-center">
            <h4>Gestion des employés</h4>
            <button data-toggle="modal" data-target="#add_modal" class="btn btn-success ml-2"><i
                    class="fa fa-plus"></i></button>
        </div>
        <!-- Modal -->

        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="add_modal_label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_modal_label">Ajouter un utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        id='edit_name' value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        id='edit_email' value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" id='edit_password'>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="edit_password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>

                                <div class="col-md-6">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror"
                                        name="role" required id='edit_role'>
                                        <option value="" disabled selected>Select a role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Create User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="card m-4">
            <div class="table-responsive">
                <table class="table ">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Email</th>
                            <th>Rôles</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge badge-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge badge-info">{{ $permission->name }}</span>
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $user->id }}">
                                        Modifier
                                    </button>
                                    <form class="d-inline" action="{{ route('users.destroy', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal de modification pour chaque utilisateur -->
                            <!-- Modal de modification pour chaque utilisateur -->
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Modifier
                                                l'utilisateur</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm{{ $user->id }}" method="POST"
                                                action="{{ route('users.update', $user->id) }}"
                                                onsubmit="return validateForm({{ $user->id }})">
                                                @csrf
                                                @method('PUT')

                                                <!-- Champs de formulaire pour la modification -->
                                                <div class="form-group">
                                                    <label for="name">Nom</label>
                                                    <input type="text" class="form-control"
                                                        id="edit_name{{ $user->id }}" name="name"
                                                        value="{{ old('name', $user->name) }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control"
                                                        id="edit_email{{ $user->id }}" name="email"
                                                        value="{{ old('email', $user->email) }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Mot de passe</label>
                                                    <input type="password" id="edit_password{{ $user->id }}"
                                                        class="form-control" id="password" name="password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password_confirmation">Confirmer le mot de passe</label>
                                                    <input type="password" class="form-control"
                                                        id="edit_password_confirmation{{ $user->id }}"
                                                        name="password_confirmation">
                                                </div>

                                                <div class="form-group">
                                                    <label for="role">Rôle</label>
                                                    <select class="form-control" id="edit_role{{ $user->id }}"
                                                        name="role">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer les
                                                        modifications</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin du modal de modification -->


                            <!-- Fin du modal de modification -->
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
    <script>
        document.getElementById('editForm').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Empêche la soumission du formulaire
            }
        });



        function validateForm(userId) {
            // Récupérer les valeurs des champs
            var name = document.getElementById('edit_name' + userId).value;
            var email = document.getElementById('edit_email' + userId).value;
            var password = document.getElementById('edit_password' + userId).value;
            var passwordConfirmation = document.getElementById('edit_password_confirmation' + userId).value;
            var role = document.getElementById('edit_role' + userId).value;

            // Effectuer la validation des champs
            if (name.trim() === '' || email.trim() === '' || role.trim() === '') {
                toastr.error('Veuillez remplir tous les champs.');
                return false; // Empêche la soumission du formulaire
            }

            if (password.trim() !== passwordConfirmation.trim()) {
                toastr.error('Le mot de passe et la confirmation du mot de passe ne correspondent pas.');
                return false; // Empêche la soumission du formulaire
            }

            return true; // Autorise la soumission du formulaire
        }
    </script>
@endsection
