@extends('layout.master')

@section('main')
    <section>
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h2 class="h4">Customers Info</h2>
            <a href="{{ route('customer.create') }}" class="btn btn-primary btn-m mr-2">Create New Customer</a>
        </div>

        <!-- Success Alert -->
        @if (session('createsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('createsuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if (session('editsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('editsuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('deletesuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deletesuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($customers->isEmpty())
            <div class="alert alert-info" role="alert">
                No customers found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-m">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
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
