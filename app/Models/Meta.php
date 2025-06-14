<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_da_meta',
        'valor_da_meta',
        'usuario_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
