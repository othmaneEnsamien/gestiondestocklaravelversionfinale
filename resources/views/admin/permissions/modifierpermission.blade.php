@extends('layouts.appdash')

@section('content')
    <form action="{{ route('permissions.update', $permission) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container">
            <h1>Edit Permission</h1>
            <div class="form-group">
                <label for="name">Permission Name</label>
                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Permission</button>


        </div>
    </form>
@endsection
