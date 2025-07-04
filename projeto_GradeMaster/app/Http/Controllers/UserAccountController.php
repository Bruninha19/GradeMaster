<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAccountController extends Controller
{
    public function store(StoreUserAccountRequest $request)
{
    try {
        $validated = $request->validated();
        
        $userAccount = UserAccount::create([
            'nome_completo' => $validated['full_name'],
            'email' => $validated['educational_email'],
            'senha' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Conta criada com sucesso!',
            'data' => $userAccount->only(['id', 'nome_completo', 'email', 'created_at'])
        ], 201);

    } catch (\Exception $e) {
        \Log::error('Erro ao criar conta: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Erro interno do servidor'
        ], 500);
    }
}
    
    // ... outros métodos permanecem iguais
}