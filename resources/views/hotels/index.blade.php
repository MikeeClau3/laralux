@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hotels</h1>
    <a href="{{ route('hotels.create') }}" class="btn btn-primary">Add Hotel</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hotels as $hotel)
            <tr>
                <td>{{ $hotel->name }}</td>
                <td>{{ $hotel->address }}</td>
                <td>{{ $hotel->phone }}</td>
                <td>{{ $hotel->email }}</td>
                <td>{{ $hotel->rating }}</td>
                <td>{{ $hotel->type }}</td>
                <td>
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display:inline-block;">
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
