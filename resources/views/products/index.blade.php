@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Hotel ID</th>
                <th>Type</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->hotel_id }}</td>
                <td>{{ $product->type }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
