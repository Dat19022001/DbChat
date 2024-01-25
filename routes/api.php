<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\User\UserController;
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
  


Route::middleware(['cors'])->group(function () {
  Route::post ("/register",[UserController::class,"createUser"]);
  Route::post("/chat", [ChatController::class, "sentChat"]);
  Route::get("/chat/{id}", [ChatController::class, "getChat"]);
  Route::post("/update",[UserController::class,"updateFriendListFromRoomChats"]);
  Route::get("/roomChats",[UserController::class,"getChatRooms"]);
  Route::get("/update/{id}",[UserController::class,"updateFriendList"]);
});
