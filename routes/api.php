<?php

use App\Http\Controllers\CatsController;
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

Route::fallback(function () {
  return NOT_FOUND("route is not found");
});

Route::group([
  'middleware' => 'api',
  'namespace' => 'App\Http\Controllers',
  'prefix' => 'auth'
], function($router) {
  Route::post("login", "AuthController@login");
  Route::post("register", "AuthController@register");
  Route::get("refresh", "AuthController@refresh");
  Route::get("me", "AuthController@me");
  Route::get("logout", "AuthController@logout");
});

Route::get('/cats', [CatsController::class, "index"]);
Route::post('/cats', [CatsController::class, "store"]);
Route::get('/cats/{id}', [CatsController::class, "show"]);
Route::put('/cats/{id}/restore', [CatsController::class, "edit"]);
Route::delete('/cats/{id}', [CatsController::class, "destroy"]);
