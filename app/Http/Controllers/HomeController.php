<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Soal 4: Ambil data Partner & Category dari DB lalu kirim ke view
    public function index()
    {
        $partners   = Partner::all();
        $categories = Category::all();

        return view('welcome', compact('partners', 'categories'));
    }
}

