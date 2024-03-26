<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SzakmaiIsmeret extends Model
{
    use HasFactory;
    protected $primaryKey = 'ismeret_id';
    protected $fillable = [
        'megnevezes',
        'szint',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
