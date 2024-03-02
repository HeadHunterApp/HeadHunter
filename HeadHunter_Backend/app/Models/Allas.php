<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allas extends Model
{
    use HasFactory;
    protected $primaryKey = 'allas_ID';
    protected $fillable = [
        'munkaltato',
        'megnevezes',
        'pozicio',
        'terulet',
        'statusz',
        'leiras',
        'datum',
        'fejvadasz',
    ];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('pozicio', '=', $this->
            getAttribute('pozicio'))
            ->where('terulet', '=', $this->
            getAttribute('megnevezes'));


        return $query;
    }

}
