<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_accounts', function (Blueprint $table) { // <--- MUDEI DE 'users' PARA 'user_accounts'
            $table->id();
            $table->string('nome_completo');        // <--- MUDADO PARA 'nome_completo'
            $table->string('email')->unique();      // <--- MUDADO PARA 'email' (e único)
            $table->string('senha');                // <--- MUDADO PARA 'senha'
            // Se você não precisa de remember_token para essas contas, pode remover.
            // Se precisar para autenticação, considere deixar, mas seu 'UserAccount' model precisaria do Trait.
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts'); // <--- MUDEI DE 'users' PARA 'user_accounts'
    }
};