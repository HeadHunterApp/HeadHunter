<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nyelvtudas extends Model
{
    use HasFactory;
    protected $primaryKey = ['nyelv', 'szint'];
    public $incrementing = false;
    protected $keyType = 'string'; 

    protected $fillable = [
        'megnevezes',
    ];
}
