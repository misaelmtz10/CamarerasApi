<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Authentication is not required for these endpoints
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Authentication is required for these endpoints (apply middleware auth:sanctum)
Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('userProfile', [AuthController::class, 'userProfile']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::put('changePassword', [AuthController::class, 'changePassword']);
    Route::get('building/getAllBelongUser', [BuildingController::class, 'getAllBelongUser']);
    Route::get('room/getAllByUser/{idBuilding}/{idStatus}', [RoomController::class, 'getAllByUser']);
    Route::put('room/updateRoom/{id}', [RoomController::class, 'update']);
    Route::put('room/getAllByRoomId/{idRoom}', [RoomController::class, 'getAllByRoomId']);
});

//Consultas para UserHasRoom
Route::prefix('room')->group(function(){
    Route::get('getAll', [RoomController::class, 'index']);
    //Route::get('getAllByUser', [RoomController::class, 'getAllByUser']);
    Route::post('assignRoom', [RoomController::class, 'store']);

});

Route::prefix('building')->group(function(){
    Route::get('getAll', [BuildingController::class, 'index']);

});
