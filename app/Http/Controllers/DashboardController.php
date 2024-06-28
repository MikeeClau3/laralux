<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tambahkan logika atau data yang ingin ditampilkan di dashboard
        return view('dashboard');
    }
}

