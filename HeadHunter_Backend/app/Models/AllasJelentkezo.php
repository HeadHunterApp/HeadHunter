<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllasJelentkezo extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allas', '=', $this->
            getAttribute('allas_id'))
            ->where('allaskereso', '=', $this->
            getAttribute('user_id'));
        return $query;
    }
    protected $fillable = [
        'allas',
        'allaskereso',
        'statusz',
    ];

    
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
