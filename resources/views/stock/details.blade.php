@extends('layout.master')

@section('main')
<div class="container">
    <h1>Stock Details for {{ $date }}</h1>

    @if(empty($stockDetails))
        <p>No stock details available for this date.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Opening Stock</th>
                    <th>Purchases</th>
                    <th>Sales</th>
                    <th>Closing Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockDetails as $details)
                    <tr>
                        <td>{{ $details['product']->name }}</td>
                        <td>{{ $details['opening'] }}</td>
                        <td>{{ $details['purchases'] }}</td>
                        <td>{{ $details['sales'] }}</td>
                        <td>{{ $details['closing'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary mt-2">Back to Stocks</a>
    @endif
</div>
@endsection
