<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Se você planeja autenticar usuários com este modelo, ele precisaria
// estender Authenticatable e usar o Notifiable, HasApiTokens, etc.,
// assim como o modelo User padrão. Mas para fins de CRUD e registro simples,
// Model é suficiente por enquanto.
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

class UserAccount extends Model
{
    use HasFactory;
    // use Notifiable, HasApiTokens; // Se você herdar de Authenticatable

    protected $table = 'user_accounts'; // Indique explicitamente o nome da sua tabela

    protected $fillable = [
        'nome_completo',
        'email',
        'senha', // Este campo será armazenado como hash
    ];

    protected $hidden = [
        'senha', // Esconder o campo 'senha' quando serializar o modelo para JSON
    ];

    // Se você usa created_at e updated_at (que sua migration tem)
    // public $timestamps = true; // Isso é true por padrão, então geralmente não precisa declarar

    // Opcional: Para ter as senhas automaticamente "hashed" quando definidas (Laravel 9+)
    // protected $casts = [
    //     'senha' => 'hashed', // Certifique-se de que sua coluna é string em vez de text
    // ];
    // Se usar isso, você pode remover o Hash::make() na controller, mas Hash::make() é mais explícito.
}