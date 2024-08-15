@extends('layout.master')

@section('main')
    <div class="container">
        <h1>Edit Sale Order</h1>

        <form action="{{ route('sale.update', $sale->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="number">Order Number:</label>
                <input type="text" class="form-control" id="number" name="number"
                    value="{{ old('number', $sale->number) }}">
                @error('number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cus_id">Customer:</label>
                <select class="form-control" id="cus_id" name="cus_id">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ $customer->id == old('cus_id', $sale->cus_id) ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('cus_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Customer Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $sale->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Customer Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $sale->phone) }}">
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <h3>Products</h3>

            <div id="products-container" class="row">
                @foreach ($sale->salesDetails as $index => $product)
                    <div class="product-entry col-12 row mb-3">
                        <div class="col-md-3 form-group">
                            <label for="products[{{ $index }}][product_id]">Product:</label>
                            <select class="form-control" name="products[{{ $index }}][product_id]"
                                onchange="fetchPrice(this, {{ $index }})">
                                <option value="">Select Product</option>
                                @foreach ($products as $p)
                                    <option value="{{ $p->id }}"
                                        {{ $p->id == old("products[{$index}][product_id]", $product->product_id) ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("products.{$index}.product_id")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="products[{{ $index }}][price]">Price:</label>
                            <input type="number" step="0.01" class="form-control"
                                name="products[{{ $index }}][price]" id="price-{{ $index }}"
                                value="{{ old("products[{$index}][price]", $product->price) }}">
                            @error("products.{$index}.price")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="products[{{ $index }}][qty]">Quantity:</label>
                            <input type="number" class="form-control" name="products[{{ $index }}][qty]"
                                oninput="calculateTotal(this.closest('.product-entry'))"
                                value="{{ old("products[{$index}][qty]", $product->qty) }}">
                            @error("products.{$index}.qty")
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="products[{{ $index }}][total]">Total:</label>
                            <input type="number" step="0.01" class="form-control"
                                name="products[{{ $index }}][total]" readonly>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
            <hr>

            <div class="col-md-3 form-group">
                <label for="final-total">Total Price:</label>
                <input type="number" step="0.01" class="form-control" id="final-total" name="final_total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update Sale</button>
        </form>
    </div>

    <script>
        function fetchPrice(selectElement, index) {
            const productId = selectElement.value;

            if (productId) {
                fetch(`/product-price/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById(`price-${index}`).value = data.price;
                        calculateTotal(selectElement.closest('.product-entry'));
                        calculateFinalTotal();
                    })
                    .catch(error => console.error('Error fetching price:', error));
            }
        }

        function calculateTotal(entry) {
            const price = entry.querySelector('input[name$="[price]"]').value;
            const qty = entry.querySelector('input[name$="[qty]"]').value;
            const totalField = entry.querySelector('input[name$="[total]"]');
            const total = (price * qty).toFixed(2);
            totalField.value = total;
        }

        function calculateFinalTotal() {
            let finalTotal = 0;
            document.querySelectorAll('.product-entry input[name$="[total]"]').forEach(totalField => {
                finalTotal += parseFloat(totalField.value) || 0;
            });
            document.getElementById('final-total').value = finalTotal.toFixed(2);
        }

        document.querySelectorAll('.product-entry').forEach(entry => {
            entry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => {
                    calculateTotal(entry);
                    calculateFinalTotal();
                });
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

                    <div class="col-md-3 form-group">
                        <button type="button" class="btn btn-danger remove-product">Remove</button>
                    </div>
                `;

            productContainer.appendChild(newProductEntry);

            newProductEntry.querySelectorAll('input[name$="[price]"], input[name$="[qty]"]').forEach(input => {
                input.addEventListener('input', () => {
                    calculateTotal(newProductEntry);
                    calculateFinalTotal();
                });
            });

            newProductEntry.querySelector('.remove-product').addEventListener('click', function() {
                newProductEntry.remove();
                calculateFinalTotal();
            });

            calculateFinalTotal();
        });
    </script>
