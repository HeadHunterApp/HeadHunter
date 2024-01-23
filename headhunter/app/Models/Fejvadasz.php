<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fejvadasz extends Model
{
    use HasFactory;
    protected $primaryKey = 'fejv_ID';
    protected $fillable = [
        'nev',
        'tel',
        'email',
        'fenykep',
    ];
}
