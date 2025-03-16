@extends('layout.master')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('role.store') }}" method="post">
                @csrf
                <div>
                    <label for="" class="form-label">Role</label>
                    <input type="text" name="roles" id="" class="form-control">
                    <span class="text-danger">
                        @error('roles')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection