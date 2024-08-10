@extends('layout.master')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Name: {{ $product->name }}</h5>
                        <p class="card-text">Product Code: {{ $product->code }}</p>
                        <p class="card-text">Product Description: {{ $product->description }}</p>
                        <p class="card-text">Category: {{ $product->category->name }}</p>
                        <p class="card-text">Reorder Qty: {{ $product->reorder_qty }}</p>
                        <p class="card-text">Refrigerated: {{ $product->refrigerated }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
