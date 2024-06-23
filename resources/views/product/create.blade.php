@extends('layout.master')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <form action="{{ route('product.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" name="name" id="" class="form-control">
                        <span class="text-danger">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Product Code</label>
                        <input type="text" name="code" id="" class="form-control">
                        <span class="text-danger">
                            @error('code')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Product Description</label>
                        <input type="text" name="description" id="" class="form-control">
                        <span class="text-danger">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" id="" class="form-select">
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('category_id')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Reorder Qty</label>
                        <input type="number" name="reorder_qty" id="" class="form-control">
                        <span class="text-danger">
                            @error('reorder_qty')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label">Refrigerated</label>
                        <input type="number" name="refrigerated" id="" class="form-control">
                        <span class="text-danger">
                            @error('refrigerated')
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