<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Munkaltato extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'munkaltato_id';

    protected $fillable = [
        'cegnev',
        'szekhely',
        'kapcsolattarto',
        'telefonszam',
        'email',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
