<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class UserAccount extends Model implements Authenticatable
{
    use HasFactory, Notifiable, AuthenticatableTrait;

    protected $table = 'user_accounts';

    protected $fillable = [
        'nome_completo',
        'email',
        'senha',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    // Necessário para implementar Authenticatable
    public function getAuthPassword()
    {
        return $this->senha;
    }

    // Se quiser usar mutators para formatar automaticamente
    public function setNomeCompletoAttribute($value)
    {
        $this->attributes['nome_completo'] = ucwords(strtolower(trim($value)));
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim($value));
    }
}