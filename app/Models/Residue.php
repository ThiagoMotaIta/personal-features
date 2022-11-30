<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residue extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name',
        'type',
        'category',
        'treatment_technology',
        'class',
        'measurement_unit',
        'weight',
    ];
}
