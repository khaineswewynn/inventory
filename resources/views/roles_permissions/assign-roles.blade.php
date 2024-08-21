@extends('layout.master')

@section('main')
<div class="container">
    <h2>Assign Roles to Users</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('update-user-role') }}" method="POST">
        @csrf

        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <label class="form-check-label">{{ $user->name }}</label>
                    </div>

                    <div class="form-group mt-2">
                        <select class="form-control" id="role_id_{{ $user->id }}" name="roles[{{ $user->id }}]">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->roles }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Roles</button>
    </form>
</div>
@endsection

