<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nyelvtudas extends Model
{
    use HasFactory;

    //protected $table = 'ideiromamagyartobbesszamot';
    protected $table = 'nyelvtudass';

    //protected $primarykey=['nyelv', 'szint']; - összetett kulcsok felszámolása
    protected $primarykey='nyelvkod';
/*      NYELVKOD = nyelvrövid kódja + [
        'A1',
        'A2',
        'B1',
        'B2',
        'C1',
        'C2'
    ]; */
    protected $fillable = [
        'nyelvkod',
        'nyelv',
        'szint',
        'megnevezes',
    ];

    public $timestamps = false;
}
