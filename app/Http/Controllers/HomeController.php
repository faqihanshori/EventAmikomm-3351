<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $events = \App\Models\Event::with('category')->latest()->take(6)->get();
        return view('welcome', compact('events'));
    }
}
