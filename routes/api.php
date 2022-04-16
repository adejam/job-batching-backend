<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\SaleController;

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::post('/upload', [SaleController::class, 'upload']);
Route::get('/batch', [SaleController::class, 'batch']);
Route::get('/batch/in-progress', [SaleController::class, 'batchInProgress']);
