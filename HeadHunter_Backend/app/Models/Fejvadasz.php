<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fejvadasz extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_ID',
        'telefonszam',
        'fenykep',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
