<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::post('/trapesium', [App\Http\Controllers\TrapesiumController::class, 'hitungKeliling']);
Route::post('/persegi-panjang', [App\Http\Controllers\PersegiPanjangController::class, 'hitungLuas']);
Route::post('/keliling-persegi-panjang', [App\Http\Controllers\KelilingPersegiPanjangController::class, 'hitungKeliling']);
Route::post('/luas-segitiga', [App\Http\Controllers\LuasSegitigaController::class, 'hitungLuas']);
Route::post('/keliling-segitiga', [App\Http\Controllers\KelilingSegitigaController::class, 'hitungKeliling']);
Route::post('/luas-lingkaran', [App\Http\Controllers\LingkaranController::class, 'luas']);
Route::post('/keliling-lingkaran', [App\Http\Controllers\KelilingLingkaranController::class, 'hitungKeliling']);
Route::post('/volume-kubus', [App\Http\Controllers\VolumeKubusController::class, 'hitungVolume']);
Route::post('/luas-permukaan-kubus', [App\Http\Controllers\LuasPermukaanKubusController::class, 'hitungLuasPermukaan']);
