<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [UserController::class, 'login']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('user.forgot-password')->with('title', 'Forgot Password');
});

// Group Auth Socialite
Route::group(['prefix' => '/auth'], function () {
    // Login with Socialite GitHub
    Route::get('/github/redirect', [UserController::class, 'githubRedirect'])->name('auth.githubRedirect');
    Route::get('/github/callback', [UserController::class, 'githubCallback'])->name('auth.githubCallback');

    // Login with Socialite Google
    Route::get('/google/redirect', [UserController::class, 'googleRedirect'])->name('auth.googleRedirect');
    Route::get('/google/callback', [UserController::class, 'googleCallback'])->name('auth.googleCallback');

    // Login with Socialite Facebook
    Route::get('/facebook/redirect', [UserController::class, 'facebookRedirect'])->name('auth.facebookRedirect');
    Route::get('/facebook/callback', [UserController::class, 'facebookCallback'])->name('auth.facebookCallback');
});

// Group Authenticated
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('dashboard/room', [DashboardController::class, 'room'])->name('room');
    Route::get('dashboard/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('update-profile');
});

// 404 Error
Route::fallback(function () {
    return view('errors.404')->with('title', '404 Error');
});
