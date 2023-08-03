<!-- permissions.blade.php -->
@extends('layouts.appdash')

@section('content')
    <div class="container-fluid">
        <div class="card special-margin" style="margin: 30px">
            <div class="card-header d-flex align-items-center">
                <h4>Gestion des permissions</h4>
                <button data-toggle="modal" data-target="#add_modal" class="btn btn-custom ml-2"><i
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
                            <form method="POST" class="p-3" action="{{ route('permissions.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Permission Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Add Permission</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card m-4">
                <table class="table">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                        style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="pagination m-2">
                {{ $permissions->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
