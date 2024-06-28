<!-- resources/views/hotels/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Hotel</h1>
    <form action="{{ route('hotels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="City Hotel">City Hotel</option>
                <option value="Residential Hotel">Residential Hotel</option>
                <option value="Motel">Motel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" class="form-control" min="0" max="5" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
