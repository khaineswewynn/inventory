@extends('layout.master')

@section('main')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('product.create') }}" class="btn btn-success">Add New Product</a>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product Name: {{ $product->name }}</h5>
                            <p class="card-text">Product Code: {{ $product->code }}</p>
                            <p class="card-text">Product Description: {{ $product->description }}</p>
                            <p class="card-text">Category: {{ $product->category->name }}</p>
                            <p class="card-text">Reorder Qty: {{ $product->reorder_qty }}</p>
                            <p class="card-text">Refrigerated: {{ $product->refrigerated }}</p>
                            <div class="mt-3">
                                <a href="{{ route('product.edit', $product->id) }}"
                                    class="btn btn-primary btn-sm mr-2">Edit</a>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure to delete this product?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
