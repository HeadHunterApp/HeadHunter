<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terulet extends Model
{
    use HasFactory;
    protected $primaryKey = 'megnevezes';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = [

    ];
}
