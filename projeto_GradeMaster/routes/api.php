<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController; // <--- Certifique-se de que esta linha está aqui!

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas da API para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "api".
|
*/

// Esta é a rota que seu frontend está chamando para registrar a conta
Route::resource('contas', UserAccountController::class);

// Sua rota de user autenticado (se tiver)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});