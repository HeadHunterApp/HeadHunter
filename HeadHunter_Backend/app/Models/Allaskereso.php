<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Allaskereso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_ID',
        'nem',
        'szul_ido',
        'telefonszam',
        'fax',
        'allampolgarsag',
        'jogositvany',
        'szoc_keszseg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
