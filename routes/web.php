<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Panel home
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin.index');

require __DIR__.'/auth.php';
