<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rotas da API carregadas pelo RouteServiceProvider dentro do grupo "api"
|
*/

Route::resource('contas', UserAccountController::class);
// Rotas para contas de usuário
Route::prefix('api')->group(function () {
    // Rota para cadastro (POST /api/contas)
    Route::post('/contas', [UserAccountController::class, 'store'])->name('api.contas.store');
    
    // Rotas adicionais que você pode precisar:
    // Route::get('/', [UserAccountController::class, 'index']); // Listar contas
    // Route::get('/{id}', [UserAccountController::class, 'show']); // Mostrar conta específica
});

// Rotas autenticadas (se usar Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Adicione outras rotas protegidas aqui
});