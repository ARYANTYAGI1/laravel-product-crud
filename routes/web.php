<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route to show login form
Route::get('login', function () {
    return view('auth.login');
})->name('login');

// Route to handle login submission
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// Route to show register form
Route::get('register', function () {
    return view('auth.register');
})->name('register');

// Route to handle registration submission
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

// Route to handle logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Grouped routes with middleware for authentication
Route::middleware('auth')->group(function () {
    // Route to display the list of products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    // Route to show the form to create a new product
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

    // Route to handle new product submission
    Route::post('products', [ProductController::class, 'store'])->name('products.store');

    // Route to show the form to edit an existing product
    Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

    // Route to handle product update submission
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');

    // Route to delete a product
    Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
