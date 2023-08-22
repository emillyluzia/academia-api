<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('cliente/store', [ClienteController::class, 'store']);

Route::get('/find/{id}', [ClienteController::class, 'pesquisarPorId']);