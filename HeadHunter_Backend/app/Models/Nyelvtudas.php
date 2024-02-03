<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nyelvtudas extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('nyelv', '=', $this
            ->getAttribute('nyelv'))
            ->where('szint', '=', $this
            ->getAttribute('szint'));

        return $query;
    }
    protected $fillable = [
        'nyelv',
        'szint',
        'megnevezes',
    ];
    
}
