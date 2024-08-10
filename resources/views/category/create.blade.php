@extends('layout.master')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('category.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" id="" class="form-control">
                        <span class="text-danger">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Category Description</label>
                        <input type="text" name="description" id="" class="form-control">
                        <span class="text-danger">
                            @error('description')
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