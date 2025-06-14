<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContaController;
use App\Http\Controllers\Api\MetaController;
use App\Http\Controllers\Api\HistoricoContaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('contas', ContaController::class);
    Route::apiResource('metas', MetaController::class);
    Route::apiResource('historico-contas', HistoricoContaController::class)->only([
    'index', 'show', 'destroy'
]);

// });
