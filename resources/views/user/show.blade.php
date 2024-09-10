@extends('layout.master')

@section('main')
<section>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">User Details</h2>
            @can('update', $user)
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit"></i> Edit
                </a>
            @endcan
            @can('delete', $user)
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            @endcan
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $user->name }}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>

                    <dt class="col-sm-3">Role:</dt>
                    <dd class="col-sm-9">{{ $user->role->roles }}</dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9">{{ $user->created_at->format('d M Y, H:i') }}</dd>

                    <dt class="col-sm-3">Updated At:</dt>
                    <dd class="col-sm-9">{{ $user->updated_at->format('d M Y, H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Add Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
