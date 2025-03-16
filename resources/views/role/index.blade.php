@extends('layout.master')
@section('main')
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('role.create') }}" class="btn btn-success">Add New Role</a>
            </div>
        </div>
        <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->roles }}</td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-success btn-sm">Edit</a>
                                <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure to delete this role?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
