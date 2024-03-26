<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoNyelvtudas extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->
            getAttribute('user_id'))
            ->where('nyelvtudas', '=', $this->
            getAttribute('nyelvkod'));


        return $query;
    }
    protected $fillable = [
        'allaskereso',
        'nyelvtudas',
        'nyelvvizsga',
        'iras',
        'olvasas',
        'beszed',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
