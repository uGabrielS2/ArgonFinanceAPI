<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoConta extends Model
{
    use HasFactory;

    protected $table = 'historico_contas';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
