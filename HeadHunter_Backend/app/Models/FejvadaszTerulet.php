<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FejvadaszTerulet extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('fejvadasz', '=', $this->
            getAttribute('user_id'))
            ->where('terulet', '=', $this->
            getAttribute('megnevezes'));


        return $query;
    }
    protected $fillable = [
        'fejvadasz',
        'terulet',
    ];
}
