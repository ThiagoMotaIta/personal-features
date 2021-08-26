<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtendimentoVirtual extends Model
{
    use HasFactory;

    protected $table = 'atendimento_virtuais';
    protected $fillable = [
        'cpf',
        'nome',
        'telefone',
        'email',
        'numero_processo',
        'assunto',
        'setor_id',
        'data_atendimento',
        'mensagem',
        'status_atendimento_id',
        'link'
    ];

    protected $dates = ['data_atendimento'];

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id', 'id');
    }

    public function status_atendimento()
    {
        return $this->belongsTo(StatusAtendimento::class, 'status_atendimento_id', 'id');
    }
}
//['cpf' => '01511251395', 'nome' => 'Rafael','telefone' => '85 8931 7720','email' => 'rafa@gmail.com','numero_processo' => null,'assunto' => 'assunto 1','setor_id' => 1,'data_atendimento' => '2021-06-01 08:00:00','mensagem' => 'Test Message',]
