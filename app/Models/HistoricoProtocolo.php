<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoProtocolo extends Model
{
    use HasFactory;

    protected $table = 'historico_protocolo';
    protected $fillable = [
        'document_id',
        'protocolo_id',
        'user_id',
        'approved_document',
        'approved_procotolo'
    ];


    public function documents()
    {
        return $this->belongsTo(Documents::class, 'document_id', 'id');
    }

    public function protocolo()
    {
        return $this->belongsTo(ProtocoloVirtual::class, 'protocolo_id', 'id');
    }
}
