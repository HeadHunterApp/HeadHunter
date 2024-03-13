<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasTapasztalat extends Model
{
    use HasFactory;
    protected $primaryKey = 'allas';
    protected $fillable = [
        'allas',
        'pozicio',
        'tapasztalat_ido',
    ];
}
