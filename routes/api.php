<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List All Users
Route::get('users', [ApiController::class, 'getAllUsers']);

// List All CLients
Route::get('clients', [ApiController::class, 'getAllClients']);

// List All Sailers
Route::get('sailers', [ApiController::class, 'getAllSailers']);

// List All Products
Route::get('products', [ApiController::class, 'getAllProducts']);

// Create new product
Route::post('cad-product', [ApiController::class, 'newProduct']);

// Delete product
Route::delete('delete-product/{id}', [ApiController::class, 'deleteProduct']);

// List All Oportunities
Route::get('oportunities', [ApiController::class, 'getAllOportunities']);

// Create new Oportunity
Route::post('cad-oportunity', [ApiController::class, 'newOportunity']);

// Delete Oportunity
Route::delete('delete-oportunity/{id}', [ApiController::class, 'deleteOportunity']);

// Edit Oportunity
Route::put('edit-oportunity/{id}', [ApiController::class, 'updateOportunity']);
