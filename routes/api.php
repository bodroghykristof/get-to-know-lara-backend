<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource("mails", "App\Http\Controllers\MailController");
Route::get("mails/to/{userId}", "App\Http\Controllers\MailController@inbox");
Route::get("mails/from/{userId}", "App\Http\Controllers\MailController@sent");
Route::get("/users", "App\Http\Controllers\UserController@index");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
