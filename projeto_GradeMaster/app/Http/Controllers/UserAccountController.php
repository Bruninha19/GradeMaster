<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Já existe, mas certifique-se que está lá

class UserAccountController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Requisição POST recebida em UserAccountController@store.'); // Adicione esta linha
        Log::info('Dados da requisição:', $request->all()); // Adicione esta linha para logar os dados

        try {
            $validated = $request->validate([
                'nome_completo' => 'required|string|max:100',
                'email' => 'required|email|unique:user_accounts,email',
                'senha' => 'required|string|min:8|confirmed',
            ]);

            Log::info('Dados validados com sucesso.'); // Adicione esta linha

            $userAccount = UserAccount::create([
                'nome_completo' => $validated['nome_completo'],
                'email' => $validated['email'],
                'senha' => Hash::make($validated['senha']),
            ]);

            Log::info('Conta de usuário criada com sucesso: ' . $userAccount->email); // Adicione esta linha

            return response()->json([
                'success' => true,
                'message' => 'Conta criada com sucesso!',
                'data' => $userAccount->only(['id', 'nome_completo', 'email', 'created_at'])
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) { // Capture exceções de validação especificamente
            Log::error('Erro de validação ao criar conta: ' . $e->getMessage(), ['errors' => $e->errors()]); // Log mais detalhado
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erro geral ao criar conta: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]); // Log mais detalhado
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor'
            ], 500);
        }
    }
}