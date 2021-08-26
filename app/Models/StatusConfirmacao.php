<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProtocoloVirtual;

class StatusConfirmacao extends Model
{
    use HasFactory;

    protected $table = 'status_confirmacao';

    protected $fillable = ['descricao'];

    public function protocoloVirtuais()
    {
        return $this->hasMany(ProtocoloVirtual::class. 'status_confirmacao_id', 'id');
    }
}
