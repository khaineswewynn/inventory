@extends('layout.master')

@section('main')
    <div class="container mt-4">
        <section class="mb-4">
            <div class="card mx-auto" style="width: 40%;">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h5 mb-0">Customer Details</h3>
                        <a href="{{ route('customer.index') }}" class="btn btn-dark">
                            <span>Back to Home Page </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $customer->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $customer->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $customer->phone }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Address:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $customer->address }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5">Invoices</h3>
                </div>
                <div class="card-body">
                    @if ($invoices->isEmpty())
                        <p>No invoices found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->amount }}</td>
                                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
