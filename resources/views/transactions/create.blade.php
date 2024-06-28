<!-- resources/views/transactions/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Transaction</h1>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="member">Member</label>
            <select name="member_id" id="member" class="form-control" required>
                @foreach($members as $member)
                <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="products">Products</label>
            <select name="products[]" id="products" class="form-control" multiple required>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantities">Quantities</label>
            <input type="number" name="quantities[]" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="points_used">Points Used</label>
            <input type="number" name="points_used" class="form-control" value="0" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
