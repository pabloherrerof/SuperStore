<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Is_Admin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
    return redirect('/products');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get("/products/create", [ProductController::class, 'create'])->middleware([Is_Admin::class])->name('products.create');
    Route::post("/products", [ProductController::class, 'store'])->middleware([Is_Admin::class])->name('product.store');
    Route::get("/products/{product}/edit", [ProductController::class, 'edit'])->middleware([Is_Admin::class])->name('product.edit');
    Route::patch("/products/{product}", [ProductController::class, 'update'])->middleware([Is_Admin::class])->name('product.update');
    Route::delete("/products/{product}", [ProductController::class, 'destroy'])->middleware([Is_Admin::class])->name('product.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/clients', [ProductController::class, 'index'])->middleware([Is_Admin::class])->name('products.index');
    Route::get("/clients/create", [ProductController::class, 'create'])->middleware([Is_Admin::class])->name('products.create');
    Route::post("/clients", [ProductController::class, 'store'])->middleware([Is_Admin::class])->name('product.store');
    Route::get("/clients/{product}/edit", [ProductController::class, 'edit'])->middleware([Is_Admin::class])->name('product.edit');
    Route::patch("/clients/{product}", [ProductController::class, 'update'])->middleware([Is_Admin::class])->name('product.update');
    Route::delete("/clients/{product}", [ProductController::class, 'destroy'])->middleware([Is_Admin::class])->name('product.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
