<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProtocoloVirtual;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $fillable = ['descricao'];

    public function protocoloVirtuais()
    {
        return $this->hasMany(ProtocoloVirtual::class. 'status_id', 'id');
    }

}
