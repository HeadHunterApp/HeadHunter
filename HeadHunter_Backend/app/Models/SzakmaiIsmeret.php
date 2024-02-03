<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SzakmaiIsmeret extends Model
{
    use HasFactory;
    protected $primaryKey = 'ismeret_ID';
    protected $fillable = [
        'megnevezes',
        'szint',
    ];
}
