<?php

use App\Http\Controllers\LojaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ViaCepController;
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


Route::post('login', [UsuarioController::class, 'authenticate']);
Route::get('check-access', [UsuarioController::class, 'check_access']);


Route::middleware(['checktoken'])->group(function () {

    Route::prefix('usuario')->group(function () {

        Route::post('create', [UsuarioController::class, 'store']);

        Route::patch('change-loja', [UsuarioController::class, 'change_loja']);

        Route::get('list/{idLoja?}', [UsuarioController::class, 'list']);

    });
    
    Route::prefix('loja')->group(function () {

        Route::post('create', [LojaController::class, 'store']);    

        Route::get('list', [LojaController::class, 'list']);

    });
    
    Route::prefix('helpers')->group(function () {

        Route::get('endereco/{cep}', [ViaCepController::class, 'get_endereco']);

    });    

});



