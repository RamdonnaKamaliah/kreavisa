<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Kirimkan kedua data
    }
}
