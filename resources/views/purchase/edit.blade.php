@extends('layout.master')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Edit Purchase of {{$purchaseOrder->order_no}}</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('purchase.update', $purchaseOrder->id) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="purchaseorder_date">Purchase Order Date:</label>
                                <input type="date" id="purchaseorder_date" name="purchaseorder_date" class="form-control @error('purchaseorder_date') is-invalid @enderror" value="{{$purchaseOrder->purchaseorder_date}}" required>
                                @error('purchaseorder_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="provider_id">Provider:</label>
                                <select class="form-control" id="provider_id" name="provider_id"  required>
                                    <option value="{{ $purchaseOrder->provider_id }}">{{ $purchaseOrder->provider->name }}</option>
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h2>Purchase Details</h2>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                <tbody id="purchase-details" class="mt-3">
                                    @foreach ($purchaseDetails as $purchaseDetail)
                                        <tr>
                                            <td>
                                                <select class="form-control" id="product_id" name="product_id[]" required>
                                                    <option value="{{ $purchaseDetail->product_id }}">{{ $purchaseDetail->product->name }}</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" id="qty" name="qty[]" class="form-control @error('qty') is-invalid @enderror" value="{{ $purchaseDetail->qty }}" required>
                                                @error('qty')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" id="price" name="price[]" class="form-control @error('price') is-invalid @enderror" value="{{ $purchaseDetail->price }}" required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-2">
                                <a href="{{ route('purchase.index') }}" class="btn btn-secondary" style="float: left;">Back to List Page</a>
                                <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection