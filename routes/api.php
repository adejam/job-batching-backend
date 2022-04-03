<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::get('/upload-file', function () {
    // return view('upload-file');
    return 'please upload file';
});

Route::post('/upload', function () {
    if (request()->has('mycsv')) {
        return request()->mycsv;
    }

    return 'please upload file';
});
