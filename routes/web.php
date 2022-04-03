<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [SalesController::class, 'index']);

Route::get('/upload-file', function () {
    return view('upload-file');
});

Route::post('/upload', [SaleController::class, 'upload']);
