<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allas extends Model
{
    use HasFactory;
    protected $primaryKey = 'allas_id';
    protected $fillable = [
        'munkaltato',
        'megnevezes',
        'terulet',
        'pozicio',
        'statusz',
        'leiras',
        'datum',
        'fejvadasz',
    ];
}
