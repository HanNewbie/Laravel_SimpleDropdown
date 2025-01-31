<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/services', [ServiceController::class, 'index']);
Route::get('/subcategories/{categoryId}', [ServiceController::class, 'getSubcategories']);
Route::get('/bandwidth/{subcategoryId}', [ServiceController::class, 'getBandwidth']);
Route::get('/harga/{bandwidthId}', [ServiceController::class, 'getHarga']); 

