<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $user = auth()->user();
    error_log($user->id);
    return $user;
});

Route::post("/login", "App\Http\Controllers\UserController@login");
Route::post("/register", "App\Http\Controllers\UserController@register");
