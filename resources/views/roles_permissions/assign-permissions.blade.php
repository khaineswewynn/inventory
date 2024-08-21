@extends('layout.master')

@section('main')
<div class="container">
    <h2>Assign Permissions to Roles</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('update-role-permissions') }}" method="POST">
        @csrf

        <div class="row">
            @foreach ($roles as $role)
                @if ($role->roles !== 'Admin')
                    <div class="col-md-4 mb-3">
                        <h3>{{ $role->roles }}</h3>
                        <div class="form-check">
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                        name="roles[{{ $role->id }}][]" 
                                        value="{{ $permission->route_name }}"
                                        {{ $role->permissions->pluck('route_name')->contains($permission->route_name) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $permission->route_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update All Permissions</button>
    </form>
</div>
@endsection

