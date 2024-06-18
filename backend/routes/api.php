<?php

use App\Http\Controllers\AuthApi\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// authentication api
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth');
});

// routes clients
Route::controller(ClientController::class)->prefix('client')->group(function () {
    Route::get('/all', 'index');
    Route::get('/{id}',  'findById');
    Route::put('/{id}/update',  'update');
    Route::delete('/{id}/delete',  'destroy');
});

// routes produtos
Route::controller(ProdutoController::class)->middleware('auth:sanctum')->prefix('product')->group(function () {
    Route::get('/all',  'index');
    Route::get('/{id}',  'findById');
    Route::get('/{category}/category', 'findByCategory');
    Route::post('/create',  'store');
    Route::put('/{id}/update',  'update');
    Route::delete('/{id}/delete',  'destroy');
});

Route::controller(PedidoController::class)->middleware('auth:sanctum')->prefix('order')->group(function () {
    Route::get('/all',  'index');
    Route::get('/orders',  'findByClient');
    Route::post('/create', 'store');
    Route::put('/{pedido_id}/update',  'update');
    Route::delete('/{pedido_id}/delete',  'destroy');
});
