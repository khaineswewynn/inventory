@extends('layout.master')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('role.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                <div>
                    <label for="" class="form-label">Role</label>
                    <input type="text" name="roles" value="{{ old('roles', $role->roles) }}" class="form-control">
                    <span class="text-danger">
                        @error('roles')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
