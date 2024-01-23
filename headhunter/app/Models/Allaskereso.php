<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allaskereso extends Model
{
    use HasFactory;
    protected $primaryKey = 'allasker_ID';
    protected $fillable = [
        'nev',
        'nem',
        'szul_ido',
        'telefonszam',
        'fax',
        'email',
        'allampolgarsag',
        'jogositvany',
        'szoc_keszseg',
    ];
}
