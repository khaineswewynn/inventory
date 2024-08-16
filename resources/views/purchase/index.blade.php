@extends('layout.master')

@section('main')
    <section>
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h2 class="h4">Purchase Orders Info</h2>
            <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-m mr-2">Order New Purchase</a>
        </div>

        <!-- Success Alert -->
        @if (session('createsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('createsuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if (session('editsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('editsuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('deletesuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deletesuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($purchaseOrders->isEmpty())
            <div class="alert alert-info" role="alert">
                No purchase found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-m">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Order-No.</th>
                            <th>Purchase Order Date</th>
                            <th>Provider</th>
                            <th>total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseOrders as $pOrder)
                            <tr>
                                <td>{{ $pOrder->id }}</td>
                                <td>{{ $pOrder->order_no }}</td>
                                <td>{{ $pOrder->purchaseorder_date }}</td>
                                <td>{{ $pOrder->provider->name }}</td>
                                <td>{{ $pOrder->total }}</td>
                                <td>
                                    <a href="{{ route('purchase.show', $pOrder->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('purchase.edit', $pOrder->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('purchase.destroy', $pOrder->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <!-- Add Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
