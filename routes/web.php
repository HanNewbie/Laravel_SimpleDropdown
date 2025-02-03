<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id_kategori}', [ServiceController::class, 'getSubkategori']);
Route::get('/services/{id_subkategori}', [ServiceController::class, 'getBandwidth']);
    