<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TipoLicenca;
use App\Models\Status;
use App\Models\StatusProtocolo;
use App\Models\StatusConfirmacao;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProtocoloVirtual extends Model
{
    use HasFactory;

    protected $table = 'protocolo_virtuais';

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'licenca',
        'requerente',
        'tipo_licenca_id',
        'empreendimento',
        'razao_social',
        'cpf',
        'cnpj',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'municipio',
        'uf',
        'telefone',
        'email',
        'status_confirmacao_id',
        'status_protocolo_id',
        'descricao',
        'licenca_gerada'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipoLicenca()
    {
        return $this->belongsTo(TipoLicenca::class, 'tipo_licenca_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function statusProtocolo()
    {
        return $this->belongsTo(StatusProtocolo::class, 'status_protocolo_id', 'id');
    }

    public function statusConfirmacao()
    {
        return $this->belongsTo(StatusConfirmacao::class, 'status_confirmacao_id', 'id');
    }



}
