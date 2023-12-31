<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoControler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo', [TodoControler::class, 'index']);

Route::post('/todo', [TodoControler::class, 'createTodo']);

Route::put('/todo/update/{id}', [TodoControler::class, 'updateTodo']);

Route::delete('/todo/delete/{id}', [TodoControler::class, 'deleteTodo']);
