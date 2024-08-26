@extends('layout.master')

@section('main')
<div class="container">
    <h1>Stock Overview</h1>

    @if(empty($stockData))
        <p>No stock data available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    {{-- <th>Stock</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockData as $date => $stock)
                    <tr>
                        <td>{{ $date }}</td>
                        {{-- <td>{{ $stock }}</td> --}}
                        <td>
                            <a href="{{ route('stocks.details', ['date' => $date]) }}" class="btn btn-primary">
                                Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
