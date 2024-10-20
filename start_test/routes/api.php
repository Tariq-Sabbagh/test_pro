<?php

use App\Http\Controllers\Login_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('singup',[Login_controller::class,'singup']);
Route::post('singin',[Login_controller::class,'singin']);
