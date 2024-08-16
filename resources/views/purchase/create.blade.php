@extends('layout.master')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Order Purchase</h2>
                        <button type="button" class="btn btn-success" id="add-row">Add New Product</button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('purchase.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="purchaseorder_date">Purchase Order Date:</label>
                                <input type="date" id="purchaseorder_date" name="purchaseorder_date" class="form-control @error('purchaseorder_date') is-invalid @enderror" required>
                                @error('purchaseorder_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="provider_id">Provider:</label>
                                <select class="form-control" id="provider_id" name="provider_id" required>
                                    <option value="" selected>Choose Provider...</option>
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
                                    <th width="100px">Action</th>
                                </tr>
                                <tbody id="purchase-details" class="mt-3">
                                    <tr>
                                        <td>
                                            <select class="form-control" id="product_id" name="product_id[]" required>
                                                <option value="" selected>Choose Product...</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" id="qty" name="qty[]" class="form-control @error('qty') is-invalid @enderror" required>
                                            @error('qty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" id="price" name="price[]" class="form-control @error('price') is-invalid @enderror" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-2">
                                <a href="{{ route('customer.index') }}" class="btn btn-secondary" style="float: left;">Back to List Page</a>
                                <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let counter = 1;

        document.getElementById('add-row').addEventListener('click', function() {
            var newRow = '<tr>' +
                '<td><select class="form-control" id="product_id_' + counter + '" name="product_id[]" required><option value="" selected>Choose Product...</option>';
            @foreach ($products as $product)
                newRow += '<option value="{{ $product->id }}">{{ $product->name }}</option>';
            @endforeach
            newRow += '</select></td>' +
                '<td><input type="number" class="form-control" id="qty_' + counter + '" name="qty[]" required></td>' +
                '<td><input type="number" class="form-control" id="price_' + counter + '" name="price[]" required></td>' +
                '<td><button type="button" class="btn btn-danger" id="remove-row_' + counter + '">Remove Row</button></td>' +
                '</tr>';
            document.getElementById('purchase-details').insertAdjacentHTML('beforeend', newRow);
            counter++;
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-danger')) {
                event.target.closest('tr').remove();
            }
        });
    </script>
@endsection