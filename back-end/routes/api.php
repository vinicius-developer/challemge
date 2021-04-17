<?php

use App\Http\Controllers\LojaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ViaCepController;
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

Route::prefix('usuario')->group(function () {
    Route::post('create', [UsuarioController::class, 'store']);    
});

Route::prefix('loja')->group(function () {
    Route::post('create', [LojaController::class, 'store']);    
});

Route::prefix('helpers')->group(function () {
    Route::get('endereco', [ViaCepController::class, 'get_endereco']);
});
