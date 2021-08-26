<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAtendimento extends Model
{
    use HasFactory;

    protected $table = 'status_atendimento';

    protected $fillable = ['descricao'];

    public function atendimentoVirtuais()
    {
        return $this->hasMany(AtendimentoVirtual::class. 'status_atendimento_id', 'id');
    }
}
