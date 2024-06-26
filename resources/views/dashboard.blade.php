<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('hotels.index') }}" class="btn btn-primary">Manage Hotels</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('transactions.index') }}" class="btn btn-primary">Manage Transactions</a>
        </div>
    </div>
</div>
@endsection
