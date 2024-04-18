<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\empleadosController;
use App\Http\Controllers\turnosController;


//Rutas de empleados
Route::get('/empleados', [empleadosController::class, 'getEmpleados']);
Route::post('/empleados', [empleadosController::class, 'postEmpleados']);

//Rutas de evaluciom
Route::get('/oncall', [empleadosController::class, 'onCall']);
Route::get('/all', [empleadosController::class, 'getEmpleadosMes']);


//Rutas de turnos
Route::get('/turnos', [turnosController::class, 'getTurnos']);

Route::post('/assign', [turnosController::class, 'postTurnos']);