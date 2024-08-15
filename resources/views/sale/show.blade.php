@extends('layout.master')

@section('main')
    <div class="container">
        <h1>Invoice</h1>

        <div class="mb-3">
            <strong>Date:</strong> {{ $sale->date }}
        </div>
        <div class="mb-3">
            <strong>Order Number:</strong> {{ $sale->number }}
        </div>
        <div class="mb-3">
            <strong>Customer:</strong> {{ $sale->customer->name }}
        </div>
        <div class="mb-3">
            <strong>Email:</strong> {{ $sale->email }}
        </div>
        <div class="mb-3">
            <strong>Phone:</strong> {{ $sale->phone }}
        </div>

        <h3>Products</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->salesDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ number_format($detail->price, 2) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ number_format($detail->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total Price:</th>
                    <th>{{ number_format($sale->salesDetails->sum('total'), 2) }}</th>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('sale.index') }}" class="btn btn-secondary mt-2">Back to Sales Orders</a>
    </div>
@endsection
