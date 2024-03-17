<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoIsmeret extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->
            getAttribute('user_id'))
            ->where('szakmai_ismeret', '=', $this->
            getAttribute('ismered_id'));


        return $query;
    }
    protected $fillable = [
        'allaskereso',
        'szakmai_ismeret'
        
    ];
}
