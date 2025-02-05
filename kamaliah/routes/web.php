<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php
Route::get('/', function () {
    return view('app'); // Laravel akan mencari file di resources/views/home.blade.php
});
