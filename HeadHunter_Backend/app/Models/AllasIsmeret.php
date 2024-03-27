<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasIsmeret extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allas', '=', $this->
            getAttribute('allas_id'))
            ->where('szakmai_ismeret', '=', $this->
            getAttribute('ismeret_id'));


        return $query;
    }
    protected $fillable = [
        'allas',
        'szakmai_ismeret',
        'elvaras_szint',
    ];

    public $timestamps = false;
}
