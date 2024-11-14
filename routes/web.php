<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/vagas/{hotel}', [HomeController::class, 'show']);
    Route::get('/mais-vagas/{hotel}/{more}', [HomeController::class, 'moreRooms']);
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'hotel',
], function() {
    Route::get('listar', [HotelController::class, 'index']);
    Route::get('ver/{hotel}', [HotelController::class, 'show']);
    Route::get('cadastrar', [HotelController::class, 'storeScreen']);
    Route::post('cadastar-salvar', [HotelController::class, 'store']);
    Route::get('editar/{hotel}', [HotelController::class, 'updateScreen']);
    Route::post('editar-salvar/{hotel}', [HotelController::class, 'update']);
    Route::get('apagar/{hotel}', [HotelController::class, 'destroy']);
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'quarto',
], function() {
    Route::get('listar', [RoomController::class, 'index']);
    Route::get('ver/{room}', [RoomController::class, 'show']);
    Route::get('cadastrar', [RoomController::class, 'storeScreen']);
    Route::post('cadastar-salvar', [RoomController::class, 'store']);
    Route::get('editar/{room}', [RoomController::class, 'updateScreen']);
    Route::post('editar-salvar/{room}', [RoomController::class, 'update']);
    Route::get('apagar/{room}', [RoomController::class, 'destroy']);
});

Route::middleware('guest')->get('/login', [LoginController::class, 'login'])->name('login');
Route::middleware('guest')->post('/authenticate', [LoginController::class, 'authenticate']);
Route::middleware('guest')->get('/logout', [LoginController::class, 'logout']);
