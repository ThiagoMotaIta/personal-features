<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOuvidoria extends Model
{
    use HasFactory;

    protected $table = 'status_ouvidorias';
    protected $fillable = [
        'descricao',
    ];

    public function ouvidoria()
    {
        return $this->hasMany(Ouvidoria::class. 'status_id', 'id');
    }
}
