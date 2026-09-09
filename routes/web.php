<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
Route::resource('buku', \App\Http\Controllers\BukuController::class);
Route::resource('member', \App\Http\Controllers\MemberController::class);