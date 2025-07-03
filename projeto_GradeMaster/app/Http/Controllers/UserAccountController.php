<?php

namespace App\Http\Controllers;

use App\Models\UserAccount; // Seu modelo para contas de usuário
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; // Importe esta classe para lidar com erros de validação

class UserAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sua lógica atual ou vazio
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Sua lógica atual ou vazio (geralmente usado para exibir um formulário Blade)
        // return view('contas.create');
    }

    /**
     * Store a newly created resource in storage.
     * Este método será chamado quando o Vue.js enviar um POST para /api/contas.
     */
    public function store(Request $request) // <-- INÍCIO DO MÉTODO STORE
    {
        try {
            // 1. Validação dos dados de entrada
            // Os nomes dos campos AQUI devem ser IGUAIS aos nomes dos campos no seu Vue.js (v-model)
            $request->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'educational_email' => ['required', 'string', 'email', 'max:255', 'unique:user_accounts,email'], // 'unique:tabela,coluna'
                'password' => ['required', 'string', 'min:6', 'confirmed'], // 'confirmed' exige o campo 'password_confirmation'
            ]);

            // 2. Criação da conta de usuário no banco de dados
            // Nomes dos campos no banco de dados (tabela user_accounts)
            $userAccount = UserAccount::create([
                'nome_completo' => $request->full_name,          // Mapeia full_name do Vue para nome_completo do DB
                'email' => $request->educational_email,         // Mapeia educational_email do Vue para email do DB
                'senha' => Hash::make($request->password),      // Mapeia password do Vue para senha do DB
            ]);

            // 3. Resposta de sucesso para o frontend Vue (JSON)
            return response()->json([
                'message' => 'Conta criada com sucesso!',
                'user_account' => $userAccount->only(['id', 'nome_completo', 'email']) // Retorna apenas dados seguros do usuário criado
            ], 201); // Código de status 201 (Created)

        } catch (ValidationException $e) {
            // Se a validação falhar, retorna os erros de validação em formato JSON com status 422
            return response()->json([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => $e->errors(), // Retorna um array de erros detalhados
            ], 422);
        } catch (\Exception $e) {
            // Captura outros erros inesperados do servidor e retorna JSON com status 500
            return response()->json([
                'message' => 'Erro interno do servidor ao criar conta.',
                'error' => $e->getMessage() // Mensagem de erro para depuração (NÃO exibir em produção)
            ], 500);
        }
    } // <-- FIM DO MÉTODO STORE

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ... sua lógica atual ou vazio
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ... sua lógica atual ou vazio
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ... sua lógica atual ou vazio
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ... sua lógica atual ou vazio
    }
}