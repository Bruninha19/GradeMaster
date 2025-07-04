<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Log; // Adicione esta linha para importar o Facade Log

Log::info('Arquivo api.php carregado.'); // Adicione esta linha

Route::post('/contas', [UserAccountController::class, 'store']);

// Exemplo de rota protegida
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});