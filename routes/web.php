<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Is_Admin;
use App\Models\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\TextUI\Configuration\GroupCollection;

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
    Route::post("/products", [ProductController::class, 'store'])->middleware([Is_Admin::class])->name('products.store');
    Route::get("/products/{product}/edit", [ProductController::class, 'edit'])->middleware([Is_Admin::class])->name('products.edit');
    Route::put("/products/{product}", [ProductController::class, 'update'])->middleware([Is_Admin::class])->name('products.update');
    Route::delete("/products/{product}", [ProductController::class, 'destroy'])->middleware([Is_Admin::class])->name('products.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/clients', [ClientController::class, 'index'])->middleware([Is_Admin::class])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->middleware([Is_Admin::class])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->middleware([Is_Admin::class])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->middleware([Is_Admin::class])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->middleware([Is_Admin::class])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->middleware([Is_Admin::class])->name('clients.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/categories', [GroupsController::class, 'index'])->name('categories.index');
    Route::get("/categories/create", [CategoryController::class, 'create'])->middleware([Is_Admin::class])->name('categories.create');
    Route::post("/categories", [CategoryController::class, 'store'])->middleware([Is_Admin::class])->name('categories.store');
    Route::get("/categories/{category}/edit", [CategoryController::class, 'edit'])->middleware([Is_Admin::class])->name('categories.edit');
    Route::put("/categories/{category}", [CategoryController::class, 'update'])->middleware([Is_Admin::class])->name('categories.update');
    Route::delete("/categories/{category}", [CategoryController::class, 'destroy'])->middleware([Is_Admin::class])->name('categories.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
