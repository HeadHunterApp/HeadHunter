<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fejvadasz extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";

    protected $fillable = [
        'user_id',
        'telefonszam',
        'fenykep',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
