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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return App\Models\User::all();
});
Route::middleware('auth:sanctum')->get('/checksession', function (Request $request) {
    return response(['status'=>'ok']);
});

Route::post('/register', ['uses'=> '\App\Http\Controllers\AuthController@register']);
Route::post('/login', ['uses'=> '\App\Http\Controllers\AuthController@login']);

Route::get('/drivers', ['uses'=> '\App\Http\Controllers\TricycleController@index']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/assign/{id}', ['uses'=> '\App\Http\Controllers\TransactionsController@assign']);
    Route::post('/adddriver', ['uses'=> '\App\Http\Controllers\TricycleController@create']);
    Route::post('/service', ['uses'=> '\App\Http\Controllers\TransactionsController@store']);
    Route::post('/pickup', ['uses'=> '\App\Http\Controllers\BookingController@pickup']);
    Route::get('/transactions', ['uses'=> '\App\Http\Controllers\TransactionsController@transactions']);
});
