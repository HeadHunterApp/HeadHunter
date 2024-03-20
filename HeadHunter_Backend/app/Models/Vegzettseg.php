<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegzettseg extends Model
{
    use HasFactory;
    protected $primaryKey = 'vegzettseg_id';
    protected $fillable = [
        'megnevezes',
    ];
}
