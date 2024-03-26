<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allas extends Model
{
    use HasFactory;

    protected $table = 'allass';
    
    protected $primaryKey = 'allas_id';
    protected $fillable = [
        'munkaltato',
        'megnevezes',
        //'terulet', - összetett kulcsok felszámolása
        'pozicio',
        'statusz',
        'leiras',
        'datum',
        'fejvadasz',
    ];
    public $timestamps = false; 
}
