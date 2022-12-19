<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login')->with('title', 'Login');
});

Route::get('/login', function () {
    return view('login')->with('title', 'Login');
});

Route::get('/register', function () {
    return view('register')->with('title', 'Registration');
});

Route::get('/forgot-password', function () {
    return view('forgot-password')->with('title', 'Forgot Password');
});

Route::get('/home', function () {
    return view('dashboard.index')->with('title', 'Dashboard');
});

Route::fallback(function () {
    return view('errors.404')->with('title', '404 Error');
});