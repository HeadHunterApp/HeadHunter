<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoNyelvtudas extends Model
{
    use HasFactory;

    protected $table = 'allaskereso_nyelvtudass';


    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->getAttribute('user_id'))
            ->where('nyelvtudas', '=', $this->getAttribute('nyelvkod'));


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

    public $timestamps = false;

    public function nyelvtudas()
    {
        return $this->hasOne(Nyelvtudas::class, 'nyelvtudas', 'nyelvkod');
    }
}
