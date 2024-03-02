<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pozicio extends Model
{
    use HasFactory;
    protected $primaryKey = 'pozicio';
    protected $fillable = [
        'terulet',
    ];
}
