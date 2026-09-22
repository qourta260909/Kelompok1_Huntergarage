<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/danish', function () {
});

Route::get('/Qourta', function () {
    return view('welcome');
});
