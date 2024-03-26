<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasNyelvtudas extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allas', '=', $this->
            getAttribute('allas_id'))
            ->where('nyelvtudas', '=', $this->
            getAttribute('nyelvkod'));


        return $query;
    }
    protected $fillable = [
        'allas',
        'nyelvtudas'
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
