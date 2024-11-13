<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/vagas/{hotel}', [HomeController::class, 'show'])->middleware('auth');
Route::get('/mais-vagas/{hotel}/{more}', [HomeController::class, 'moreRooms'])->middleware('auth');

Route::get('/hotel/listar', [HotelController::class, 'index'])->middleware('auth');
Route::get('/hotel/ver/{hotel}', [HotelController::class, 'show'])->middleware('auth');
Route::get('/hotel/cadastrar', [HotelController::class, 'storeScreen'])->middleware('auth');
Route::post('/hotel/cadastar-salvar', [HotelController::class, 'store'])->middleware('auth');
Route::get('/hotel/editar/{hotel}', [HotelController::class, 'updateScreen'])->middleware('auth');
Route::post('/hotel/editar-salvar/{hotel}', [HotelController::class, 'update'])->middleware('auth');
Route::get('/hotel/apagar/{hotel}', [HotelController::class, 'destroy'])->middleware('auth');

Route::get('/quarto/listar', [RoomController::class, 'index'])->middleware('auth');
Route::get('/quarto/ver/{room}', [RoomController::class, 'show'])->middleware('auth');
Route::get('/quarto/cadastrar', [RoomController::class, 'storeScreen'])->middleware('auth');
Route::post('/quarto/cadastar-salvar', [RoomController::class, 'store'])->middleware('auth');
Route::get('/quarto/editar/{room}', [RoomController::class, 'updateScreen'])->middleware('auth');
Route::post('/quarto/editar-salvar/{room}', [RoomController::class, 'update'])->middleware('auth');
Route::get('/quarto/apagar/{room}', [RoomController::class, 'destroy'])->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
