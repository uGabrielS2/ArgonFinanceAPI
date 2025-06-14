<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_da_conta',
        'data',
        'valor_total',
        'agua',
        'luz',
        'gas',
        'lazer',
        'outros',
        'usuario_id',
    ];

    /**
     * Relacionamento com o usuário (tabela 'usuarios').
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
