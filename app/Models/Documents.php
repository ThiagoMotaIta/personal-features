<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoLicenca;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'name',
        'licenca_id',
        'orientation',
        'required',
        'extension' 
    ];

    public function tipoLicenca()
    {
        return $this->belongsTo(TipoLicenca::class, 'licenca_id', 'id');
    }



}
