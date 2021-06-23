<?php

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

Auth::routes(["verify" => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Annonces 
Route::get('/annonces', [App\Http\Controllers\AnnoncesController::class, 'index']);

// barre de recherche
Route::resource('/annonces', App\Http\Controllers\AnnoncesController::class);
Route::post('/search',[App\Http\Controllers\AnnoncesController::class, 'search'])->name('posts.search');

// Création d'annonces
Route::get('/create', [App\Http\Controllers\AnnoncesController::class, 'create']);
Route::post('/store', [App\Http\Controllers\AnnoncesController::class, 'store']);
Route::post('/create', [App\Http\Controllers\AnnoncesController::class, 'store']);



