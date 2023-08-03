@extends('layouts.appdash')

@section('content')

    <div class="container">
        <h1 class="mb-4 text-center text-primary display-4 font-weight-bold">Modifier le rôle</h1>
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
    <div class="container">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom du rôle</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="list-group" style="max-height: 200px; overflow-y: auto;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="select-all-checkbox">
                        <label class="form-check-label" for="select-all-checkbox">Sélectionner/Désélectionner tous</label>
                    </div>
                    @foreach ($permissions as $permission)
                        <div class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('roles.index') }}" class="btn btn-outline-primary btn-lg">Gérer les rôles</a>
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
@endpush
