<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasVegzettseg extends Model
{
    use HasFactory;
    protected $primaryKey = 'allas';
    protected $fillable = [
        'allas',
        'vegzettseg',
    ];
}
