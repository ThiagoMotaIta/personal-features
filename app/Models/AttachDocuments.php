<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProtocoloVirtual;

class AttachDocuments extends Model
{
    use HasFactory;

    protected $table = 'attach_documents';

    protected $fillable = [
        'protocolo_id',
        'name',
        'orientation',
        'required',
        'extension' 
    ];

    public function protocoloVirtual() {
        return $this->belongsTo(ProtocoloVirtual::class, 'protocolo_id', 'id');
    }


}
