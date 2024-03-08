<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pozicio extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('terulet', '=', $this->
            getAttribute('megnevezes'))
            ->where('pozicio', '=', $this->
            getAttribute('pozicio'));
        return $query;
    }    

    protected $fillable = [
        'terulet',
        'pozicio',
    ];
}
