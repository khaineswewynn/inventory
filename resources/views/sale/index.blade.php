@extends('layout.master')

@section('main')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <h1>Sales Orders</h1>
        <a href="{{ route('sale.create') }}" class="btn btn-primary">Create Sale</a>

        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ ($sales->currentPage() - 1) * $sales->perPage() + $loop->iteration }}</td>
                        <td>{{ $sale->date }}</td>
                        <td>{{ $sale->number }}</td>
                        <td>{{ $sale->customer->name }}</td>
                        <td>{{ $sale->email }}</td>
                        <td>{{ $sale->phone }}</td>
                        <td>
                            @php
                                $totalAmount = $sale->salesDetails->sum('total');
                            @endphp
                            {{ number_format($totalAmount, 2) }}
                        </td>
                        <td class="d-flex">
                            <a href="{{ route('sale.edit', $sale->id) }}" class="btn btn-success p-2">Edit</a>
                            <a href="{{ route('sale.show', $sale->id) }}" class="btn btn-info p-2 mx-2">Details</a>
                            <form action="{{ route('sale.destroy', $sale->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger p-2"
                                    onclick="return confirm('Are you sure to delele this sales order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $sales->links() }}
        </div>
    </div>
@endsection
