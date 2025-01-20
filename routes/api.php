<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('save-card', [ApiController::class, 'saveCard']);
Route::post('check-card', [ApiController::class, 'checkCard']);

Route::get('get-list', [ApiController::class, 'getList']);
