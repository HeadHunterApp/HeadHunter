<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terulet extends Model
{
    use HasFactory;
    protected $primaryKey = 'terulet_id';
    protected $fillable = [
        'megnevezes',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
