{{-- @extends('layout.master')

@section('main')
    <div class="container">
        <h1>Create Sale Order</h1>

        <form action="{{ route('sale.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="number">Order Number:</label>
                <input type="text" class="form-control" id="number" name="number">
                @error('number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cus_id">Customer:</label>
                <select class="form-control" id="cus_id" name="cus_id">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('cus_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Customer Email:</label>
                <input type="email" class="form-control" id="email" name="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Customer Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h3>Products</h3>

            <div id="products-container" class="row">
                <div class="product-entry col-12 row mb-3">
                    <div class="col-md-3 form-group">
                        <label for="products[0][product_id]">Product:</label>
                        <select class="form-control" name="products[0][product_id]">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('products.0.product_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][price]">Price:</label>
                        <input type="number" step="0.01" class="form-control" name="products[0][price]">
                        @error('products.0.price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][qty]">Quantity:</label>
                        <input type="number" class="form-control" name="products[0][qty]">
                        @error('products.0.qty')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][total]">Total:</label>
                        <input type="number" step="0.01" class="form-control" name="products[0][total]" readonly>
                    </div>
                </div>
            </div>

            <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
            <hr>

            <div class="col-md-3 form-group">
                <label for="final-total">Total Price:</label>
                <input type="number" step="0.01" class="form-control" id="final-total" name="final_total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Create Sale</button>
        </form>
    </div>

    <script>
        function calculateTotal(entry) {
            const price = entry.querySelector('input[name$="[price]"]').value;
            const qty = entry.querySelector('input[name$="[qty]"]').value;
            const totalField = entry.querySelector('input[name$="[total]"]');
            const total = (price * qty).toFixed(2);
            totalField.value = total;

            calculateFinalTotal();
        }

        function calculateFinalTotal() {
            const productEntries = document.querySelectorAll('.product-entry');
            let finalTotal = 0;

            productEntries.forEach(entry => {
                const totalField = entry.querySelector('input[name$="[total]"]');
                const total = parseFloat(totalField.value) || 0;
                finalTotal += total;
            });

            document.getElementById('final-total').value = finalTotal.toFixed(2);
        }

        document.querySelectorAll('.product-entry').forEach(entry => {
            entry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => calculateTotal(entry));
            });
        });

        document.getElementById('add-product').addEventListener('click', function() {
            const productContainer = document.getElementById('products-container');
            const productEntries = productContainer.getElementsByClassName('product-entry');
            const newIndex = productEntries.length;

            const newProductEntry = document.createElement('div');
            newProductEntry.classList.add('product-entry', 'col-12', 'row', 'mb-3');
            newProductEntry.innerHTML = `
            <div class="col-md-3 form-group">
                <label for="products[${newIndex}][product_id]">Product:</label>
                <select class="form-control" name="products[${newIndex}][product_id]">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('products.${newIndex}.product_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="products[${newIndex}][price]">Price:</label>
                <input type="number" step="0.01" class="form-control" name="products[${newIndex}][price]">
                @error('products.${newIndex}.price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="products[${newIndex}][qty]">Quantity:</label>
                <input type="number" class="form-control" name="products[${newIndex}][qty]">
                @error('products.${newIndex}.qty')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 form-group">
                <label for="products[${newIndex}][total]">Total:</label>
                <input type="number" step="0.01" class="form-control" name="products[${newIndex}][total]" readonly>
            </div>

            <div class="col-md-12 text-right mt-2">
                <button type="button" class="btn btn-danger remove-product">Remove</button>
            </div>
            `;

            productContainer.appendChild(newProductEntry);

            newProductEntry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => calculateTotal(newProductEntry));
            });

            newProductEntry.querySelector('.remove-product').addEventListener('click', function() {
                productContainer.removeChild(newProductEntry);
                calculateFinalTotal();
            });
        });
    </script>
@endsection --}}

@extends('layout.master')

@section('main')
    <div class="container">
        <h1>Create Sale Order</h1>

        <form action="{{ route('sale.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="number">Order Number:</label>
                <input type="text" class="form-control" id="number" name="number">
                @error('number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cus_id">Customer:</label>
                <select class="form-control" id="cus_id" name="cus_id">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('cus_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Customer Email:</label>
                <input type="email" class="form-control" id="email" name="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Customer Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h3>Products</h3>

            <div id="products-container" class="row">
                <div class="product-entry col-12 row mb-3">
                    <div class="col-md-3 form-group">
                        <label for="products[0][product_id]">Product:</label>
                        <select class="form-control" name="products[0][product_id]" onchange="fetchProductPrice(this)">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('products.0.product_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][price]">Price:</label>
                        <input type="number" step="0.01" class="form-control" name="products[0][price]" readonly>
                        @error('products.0.price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][qty]">Quantity:</label>
                        <input type="number" class="form-control" name="products[0][qty]">
                        @error('products.0.qty')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="products[0][total]">Total:</label>
                        <input type="number" step="0.01" class="form-control" name="products[0][total]" readonly>
                    </div>
                </div>
            </div>

            <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
            <hr>

            <div class="col-md-3 form-group">
                <label for="final-total">Total Price:</label>
                <input type="number" step="0.01" class="form-control" id="final-total" name="final_total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Create Sale</button>
        </form>
    </div>

    <script>
        function fetchProductPrice(selectElement) {
            const productId = selectElement.value;
            const entry = selectElement.closest('.product-entry');
            const priceField = entry.querySelector('input[name$="[price]"]');

            if (productId) {
                fetch(`/product-price/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        priceField.value = data.price || '';
                        calculateTotal(entry);
                    })
                    .catch(error => console.error('Error fetching price:', error));
            } else {
                priceField.value = '';
                calculateTotal(entry);
            }
        }

        function calculateTotal(entry) {
            const price = entry.querySelector('input[name$="[price]"]').value;
            const qty = entry.querySelector('input[name$="[qty]"]').value;
            const totalField = entry.querySelector('input[name$="[total]"]');
            const total = (price * qty).toFixed(2);
            totalField.value = total;

            calculateFinalTotal();
        }

        function calculateFinalTotal() {
            const productEntries = document.querySelectorAll('.product-entry');
            let finalTotal = 0;

            productEntries.forEach(entry => {
                const totalField = entry.querySelector('input[name$="[total]"]');
                const total = parseFloat(totalField.value) || 0;
                finalTotal += total;
            });

            document.getElementById('final-total').value = finalTotal.toFixed(2);
        }

        document.querySelectorAll('.product-entry').forEach(entry => {
            entry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => calculateTotal(entry));
            });
        });

        document.getElementById('add-product').addEventListener('click', function() {
            const productContainer = document.getElementById('products-container');
            const productEntries = productContainer.getElementsByClassName('product-entry');
            const newIndex = productEntries.length;

            const newProductEntry = document.createElement('div');
            newProductEntry.classList.add('product-entry', 'col-12', 'row', 'mb-3');
            newProductEntry.innerHTML = `
                <div class="col-md-3 form-group">
                    <label for="products[${newIndex}][product_id]">Product:</label>
                    <select class="form-control" name="products[${newIndex}][product_id]" onchange="fetchProductPrice(this)">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('products.${newIndex}.product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label for="products[${newIndex}][price]">Price:</label>
                    <input type="number" step="0.01" class="form-control" name="products[${newIndex}][price]" readonly>
                    @error('products.${newIndex}.price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label for="products[${newIndex}][qty]">Quantity:</label>
                    <input type="number" class="form-control" name="products[${newIndex}][qty]">
                    @error('products.${newIndex}.qty')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 form-group">
                    <label for="products[${newIndex}][total]">Total:</label>
                    <input type="number" step="0.01" class="form-control" name="products[${newIndex}][total]" readonly>
                </div>

                <div class="col-md-12 text-right mt-2">
                    <button type="button" class="btn btn-danger remove-product">Remove</button>
                </div>
            `;

            productContainer.appendChild(newProductEntry);

            newProductEntry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => calculateTotal(newProductEntry));
            });

            newProductEntry.querySelector('.remove-product').addEventListener('click', function() {
                productContainer.removeChild(newProductEntry);
                calculateFinalTotal();
            });

            newProductEntry.querySelector('select[name$="[product_id]"]').addEventListener('change', function() {
                fetchProductPrice(this);
            });
        });
    </script>
@endsection
