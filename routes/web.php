<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id_kategori}', [ServiceController::class, 'getSubkategori']);
Route::get('/bandwidth/{id_subkategori}', [ServiceController::class, 'getBandwidth']);
Route::get('/details/{details}', [ServiceController::class, 'getDetails']);
