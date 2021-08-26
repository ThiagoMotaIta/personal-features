<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\User;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $fillable = [
        'user_id',
        'setor_id',
        'data',
        'horario',
    ];

    protected $casts = [
        'data' => 'date:Y-m-d',
    ];

    public function setDataAttribute($value)
    {   
        $this->attributes['data'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
