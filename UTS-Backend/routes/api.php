<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;

// Route untuk mendapatkan informasi pengguna yang terautentikasi
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); // Menggunakan middleware 'auth:sanctum' untuk memastikan pengguna terautentikasi

// Route untuk mengelola berita
Route::get('/news', [NewsController::class, 'index']); // Mendapatkan daftar semua berita
Route::post('/news', [NewsController::class, 'store']); // Menyimpan berita baru
Route::get('/news/{id}', [NewsController::class, 'show']); // Mendapatkan berita berdasarkan ID
Route::put('/news/{id}', [NewsController::class, 'update']); // Memperbarui berita berdasarkan ID
Route::delete('/news/{id}', [NewsController::class, 'destroy']); // Menghapus berita berdasarkan ID

// Route untuk pencarian berita berdasarkan judul
Route::get('/news/search/{title}', [NewsController::class, 'search']); // Mencari berita dengan judul tertentu

// Route untuk mendapatkan berita berdasarkan kategori
Route::get('/news/category/sport', [NewsController::class, 'sport']); // Mendapatkan berita kategori olahraga
Route::get('/news/category/finance', [NewsController::class, 'finance']); // Mendapatkan berita kategori keuangan
Route::get('/news/category/automotive', [NewsController::class, 'automotive']); // Mendapatkan berita kategori otomotif

// Route untuk otentikasi pengguna
Route::post('/register', [AuthController::class, 'register']); // Mendaftar pengguna baru
Route::post('/login', [AuthController::class, 'login']); // Masuk pengguna yang sudah terdaftar