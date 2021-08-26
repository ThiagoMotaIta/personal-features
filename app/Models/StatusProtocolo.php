<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusProtocolo extends Model
{
    use HasFactory;

    protected $table = 'status_protocolos';

    protected $fillable = ['descricao'];

    public function protocoloVirtuais()
    {
        return $this->hasMany(ProtocoloVirtual::class. 'status_protocolo_id', 'id');
    }
}
