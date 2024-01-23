<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Munkaltato extends Model
{
    use HasFactory;
    protected $primaryKey = 'munkaltato_ID';
    protected $fillable = [
        'cegnev',
        'szekhely',
        'kapcsolattarto',
        'telefonszam',
        'email',
    ];
}
