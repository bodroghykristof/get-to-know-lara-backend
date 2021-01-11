<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

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

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::apiResource("mails", "App\Http\Controllers\MailController")
        ->except(["index"]);

    Route::get("mails/to/{userId}", "App\Http\Controllers\MailController@inbox");
    Route::get("mails/from/{userId}", "App\Http\Controllers\MailController@sent");
    Route::get("mails/drafts/{userId}", "App\Http\Controllers\MailController@sent");
    Route::get("/users", "App\Http\Controllers\UserController@index");

    }
);

Route::group([
    'middleware' => ['api'],
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
