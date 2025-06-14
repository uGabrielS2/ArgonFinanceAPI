<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🔗 Relacionamentos personalizados
    public function contas()
    {
        return $this->hasMany(Conta::class);
    }

    public function metas()
    {
        return $this->hasMany(Meta::class);
    }

    public function historicoContas()
    {
        return $this->hasMany(HistoricoConta::class);
    }
}
