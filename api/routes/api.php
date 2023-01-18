<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminCtrl;
use App\Http\Controllers\RoomCtrl;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// admin
Route::post('ksvx/v1/admin/create', [AdminCtrl::class, 'Create']);
Route::get('ksvx/v1/admin/get', [AdminCtrl::class, 'Get']);

// room
Route::post('ksvx/v1/room/create', [RoomCtrl::class, 'Create']);
Route::get('ksvx/v1/room/get', [RoomCtrl::class, 'Get']);