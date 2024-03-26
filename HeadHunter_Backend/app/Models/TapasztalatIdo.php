<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapasztalatIdo extends Model
{
    use HasFactory;
    protected $primaryKey = 'tapasztalat_id';
    protected $fillable = [
        'leiras',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
