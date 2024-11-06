<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
<<<<<<< HEAD
=======
use App\Http\Controllers\StudentController;
>>>>>>> 4af06d4 (Rest API)

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

# method get
Route::get('/animals', [AnimalController::class, 'index']);

# method post
Route::post('/animals', [AnimalController::class, 'store']);

# method put
Route::put('/animals/{id}', [AnimalController::class, 'update']);

# method delete
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);
<<<<<<< HEAD
=======

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);
>>>>>>> 4af06d4 (Rest API)
