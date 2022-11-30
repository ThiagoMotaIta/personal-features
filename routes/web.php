<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortalNewController;

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

// Just to check logged user via JSON -- Not used in this System (Its a PLUS)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Defaut route
Route::get('/', function () {
    return redirect('home');
});

// General data for home page
Route::get('home', [PortalNewController::class, 'index'])->middleware(['auth'])->name('home.index');

// List all news
Route::get('news', [PortalNewController::class, 'getAllNews']);

// List news by search
Route::post('news-search', [PortalNewController::class, 'getAllNewsBySearch']);

// Add new
Route::post('add-new', [PortalNewController::class, 'addNew']);

// Delete a new
Route::delete('delete-new', [PortalNewController::class, 'deleteNew']);

// select data frow a especific new
Route::get('new-by-id', [PortalNewController::class, 'getNewById']);

// Edit new
Route::put('edit-new', [PortalNewController::class, 'editNew']);

require __DIR__.'/auth.php';
