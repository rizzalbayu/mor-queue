<?php

use App\Http\Controllers\QueueController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users', [UserController::class,'register']);
Route::post('/users/login', [UserController::class,'login']);

Route::middleware(ApiAuthMiddleware::class)->group(function(){
  Route::get('/queues', [QueueController::class,'search']);
  Route::get('/queues/today-confirm', [QueueController::class,'todayConfirm']);
  Route::put('/queues/confirm/{id}', [QueueController::class,'confirm'])->where('id','[0-9]+');
  Route::put('/queues/serve/{id}', [QueueController::class,'serve'])->where('id','[0-9]+');
  Route::put('/queues/complete/{id}', [QueueController::class,'complete'])->where('id','[0-9]+');
});
