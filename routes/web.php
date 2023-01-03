<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoggedinController;
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

Route::get('home', [LoggedinController::class, 'index'])->name('home');

Route::get('/auth/github/redirect', [UserController::class, 'githubRedirect'])->name('auth.githubRedirect');

Route::get('/auth/github/callback', [UserController::class, 'githubCallback'])->name('auth.githubCallback');

Route::get('/auth/google/redirect', [UserController::class, 'googleRedirect'])->name('auth.googleRedirect');

Route::get('/auth/google/callback', [UserController::class, 'googleCallback'])->name('auth.googleCallback');

Route::get('/auth/facebook/redirect', [UserController::class, 'facebookRedirect'])->name('auth.facebookRedirect');

Route::get('/auth/facebook/callback', [UserController::class, 'facebookCallback'])->name('auth.facebookCallback');



Route::get('/forgot-password', function () {
    return view('user.forgot-password')->with('title', 'Forgot Password');
});

// Route::get('/home', function () {
//     return view('dashboard.index')->with('title', 'Dashboard');
// });

Route::fallback(function () {
    return view('errors.404')->with('title', '404 Error');
});
