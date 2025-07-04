<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserAccountController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nome_completo' => 'required|string|max:100',
                'email' => 'required|email|unique:user_accounts,email',
                'senha' => 'required|string|min:8|confirmed',
            ]);

            $userAccount = UserAccount::create([
                'nome_completo' => $validated['nome_completo'],
                'email' => $validated['email'],
                'senha' => Hash::make($validated['senha']),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Conta criada com sucesso!',
                'data' => $userAccount->only(['id', 'nome_completo', 'email', 'created_at'])
            ], 201);
        } catch (\Exception $e) {
            Log::error('Erro ao criar conta: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
