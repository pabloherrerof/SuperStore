<?php

use App\Http\Controllers\API\ApiClientController;
use App\Http\Controllers\API\ApiProductController;
use App\Http\Controllers\API\ApiCategoryController;
use App\Http\Middleware\Is_Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken('token-name')->plainTextToken;
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ApiProductController::class, 'index']);
    Route::get('/products/{product}', [ApiProductController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [ApiCategoryController::class, 'index']);
    Route::get('/categories/{category}', [ApiCategoryController::class, 'show']);
});


    Route::get('/clients', [ApiClientController::class, 'index']);
    Route::get('/clients/{client}', [ApiClientController::class, 'show']);


Route::fallback(function(){
    return response()->json([
        'message' => 'Resource not found.'
    ], 404);
});