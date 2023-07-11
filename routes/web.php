<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::group(['middleware' => ['auth','admin']], function() {

    Route::resource('/books', BookController::class);
    Route::get('/borrowers', [BorrowerController::class, 'index'])->name('borrowers');
    Route::get('/users', [UserController::class, 'index'])->name('users');

});

Route::resource('/books', BookController::class)->only(['index','show'])->middleware('auth');
