<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasNyelvtudas extends Model
{
    use HasFactory;

    protected $table = 'allas_nyelvtudass';

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

    public $timestamps = false;
}
