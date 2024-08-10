@extends('layout.master')

@section('main')
    <section class="mt-5">
        <div class="container">
            <h3 class="mb-4">Category Information</h3>
            <div class="bg-light p-4 rounded shadow-sm">
                <h4>Id: <span class="text-muted">{{ $category->id }}</span></h4>
                <h4>Name: <span class="text-muted">{{ $category->name }}</span></h4>
                <h4>Description: <span class="text-muted">{{ $category->description }}</span></h4>

                <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </section>
@endsection