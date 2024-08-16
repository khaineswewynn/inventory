@extends('layout.master')

@section('main')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .invoice-container {
        width: 80%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        border-radius: 8px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo h1 {
        margin: 0;
        color: #4b70f9;
        font-size: 36px;
        line-height: 1;
    }

    .invoice-details {
        text-align: right;
    }

    .invoice-details h1 {
        margin: 0;
        color: #1E3AA3;
        font-size: 24px;
    }

    .invoice-details p {
        margin: 5px 0;
        font-size: 14px;
    }

    .invoice-info {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .invoice-to,
    .invoice-from {
        width: 45%;
    }

    .invoice-to h3,
    .invoice-from h3 {
        margin-bottom: 5px;
        font-size: 16px;
        color: #1E3AA3;
    }

    .invoice-to p,
    .invoice-from p {
        margin: 2px 0;
        font-size: 14px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }

    .invoice-table td {
        font-size: 14px;
    }

    .invoice-total {
        text-align: right;
        margin-top: 20px;
        border-top: 2px solid #ddd;
        padding-top: 10px;
    }

    .invoice-total p {
        margin: 5px 0;
        font-size: 14px;
    }

    .invoice-total .grand-total {
        font-size: 18px;
        font-weight: bold;
        color: #1E3AA3;
    }

    .invoice-total span {
        margin-left: 10px;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .footer p {
        margin: 0;
        font-size: 14px;
        color: #1E3AA3;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
        margin: 0 5px;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        padding: 0 20px;
    }

    .btn-container a {
        margin: 0 10px;
    }
</style>

<section class="mt-3">
    <div class="btn-container">
        <a href="{{ route('purchase.index') }}" class="btn btn-primary">Back to List Page</a>
        <a href="{{ route('invoice.download', $purchaseOrder->id) }}" class="btn btn-primary">Download</a>
    </div>
    <div class="invoice-container mt-5">
        <div class="header">
            <div class="logo">
                <h1>HMM Inventory</h1>
            </div>
            <div class="invoice-details">
                <h1>Invoice</h1>
                <p>Order Code: {{ $purchaseOrder->order_no }}</p>
                <p>Date: {{ \Carbon\Carbon::parse($purchaseOrder->purchaseorder_date)->format('d M Y') }}</p>
            </div>
        </div>
        <div class="invoice-info">
            <div class="invoice-to">
                <h3>Product</h3>
                @foreach ($purchaseDetails as $purchaseDetail)
                    <p>{{ $purchaseDetail->product->name }}</p>
                @endforeach
            </div>
            <div class="invoice-from">
                <h3>Provider</h3>
                <p>{{ $purchaseOrder->provider->name }}</p>
            </div>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subTotal = 0;
                @endphp
                @foreach ($purchaseDetails as $index => $purchaseDetail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $purchaseDetail->product->name }}</td>
                        <td>${{ number_format($purchaseDetail->price, 2) }}</td>
                        <td>{{ $purchaseDetail->qty }}</td>
                        <td>${{ number_format($purchaseDetail->qty * $purchaseDetail->price, 2) }}</td>
                        @php
                            $subTotal += $purchaseDetail->qty * $purchaseDetail->price;
                        @endphp
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="invoice-total">
            <p>SubTotal: <span>${{ number_format($subTotal, 2) }}</span></p>
            <p>Tax: <span>$0.00</span></p>
            <p class="grand-total">Grand Total: <span>${{ number_format($subTotal, 2) }}</span></p>
        </div>
        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</section>
@endsection
