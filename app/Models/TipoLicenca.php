<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProtocoloVirtual;

class TipoLicenca extends Model
{
    use HasFactory;

    //protected $table = 'tipo_licencas';

    protected $fillable = ['descricao'];

    public function protocoloVirtuais()
    {
        return $this->hasMany(ProtocoloVirtual::class. 'tipo_licenca_id', 'id');
    }
}
