<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';
    protected $fillable = [
        'nome',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class. 'setor_id', 'id');
    }

    public function atedimentoVirtuais()
    {
        return $this->hasMany(AtendimentoVirtual::class, 'setor_id', 'id');
    }

}
