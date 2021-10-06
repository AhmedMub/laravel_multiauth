<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLogin;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('user.home');


//* Admin Login Routes
Route::prefix('admin/')->name('admin.')->group(function () {

    //this is for guest only
    //& this to prevent admin from accessing login page after successfully authenticated, this is handled by guest middleware which is RedirectIfAuthenticated.php
    Route::middleware(['guest:admin'])->group(function () {

        Route::get('login', [AdminLogin::class, 'showAdminLoginForm'])->name('login');

        Route::post('check', [AdminLogin::class, 'adminCheck'])->name('check');
    });

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('home', [AdminController::class, 'index'])->name('home');

        Route::post('logout', [AdminLogin::class, 'logout'])->name('logout');
    });
});
