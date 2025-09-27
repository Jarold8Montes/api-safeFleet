<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OperadorController;
use App\Http\Controllers\Api\TractoController;
use App\Http\Controllers\Api\ViajeController;
use App\Http\Controllers\Api\DictamenController;
use App\Http\Controllers\Api\AlertaController;
use App\Http\Controllers\Api\RangoBPMController;
use App\Http\Middleware\DeviceKey;

Route::get('/health', fn() => response()->json(['status'=>'ok']));

Route::prefix('auth')->group(function () {
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/refresh', [AuthController::class, 'refresh']);
  Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () { 
  // Operadores
  Route::get('/operadores', [OperadorController::class, 'index']);
  Route::get('/operadores/{id}', [OperadorController::class, 'show']);
  Route::post('/operadores', [OperadorController::class, 'store']);
  Route::put('/operadores/{id}', [OperadorController::class, 'update']);
  Route::delete('/operadores/{id}', [OperadorController::class, 'destroy']);

  Route::get('/rangobpm/{id_operador}', [RangoBPMController::class, 'calculate']);

  Route::get('/search/operadores', [OperadorController::class, 'search']);
  Route::get('/historial/operador/{id}', [DictamenController::class, 'historialPorOperador']);

  // Tractos
  Route::apiResource('tractos', TractoController::class);

  // Viajes
  Route::get('/viajes', [ViajeController::class, 'index']);
  Route::get('/viajes/{id}', [ViajeController::class, 'show']);
  Route::post('/viajes', [ViajeController::class, 'store']);
  Route::put('/viajes/{id}', [ViajeController::class, 'update']);
  Route::patch('/viajes/{id}/estado', [ViajeController::class, 'cambiarEstado']);
  Route::delete('/viajes/{id}', [ViajeController::class, 'destroy']);

  // Dictámenes 
  Route::get('/dictamenes', [DictamenController::class, 'index']);
  Route::get('/dictamenes/{id}', [DictamenController::class, 'show']);

  // Alertas 
  Route::get('/alertas', [AlertaController::class, 'index']);
  Route::patch('/alertas/{id}/leida', [AlertaController::class, 'marcarLeida']);
});

Route::middleware(DeviceKey::class)->prefix('v1')->group(function () {
  Route::post('/dictamenes', [DictamenController::class, 'store']);
});