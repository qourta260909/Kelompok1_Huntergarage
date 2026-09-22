<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/danish', function () {
    return view('welcome');
});

Route::get('/Qourta', function () {
    return view('welcome');
});

Route::get('/Royyan', function () {
    return view('welcome');
});

git config --global user.email "you@example.com"
  git config --global user.name "Your Name"