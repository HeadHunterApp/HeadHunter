<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nyelvtudas extends Model
{
    use HasFactory;

    //protected $primarykey=['nyelv', 'szint']; - összetett kulcsok felszámolása
    protected $primarykey='nyelvkod';
    protected $fillable = [
        'nyelvkod',
        'nyelv',
        'szint',
        'megnevezes',
    ];
    
}
