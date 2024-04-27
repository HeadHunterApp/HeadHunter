<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoTanulmany extends Model
{
    use HasFactory;

    protected $table = 'allaskereso_tanulmanys';

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->getAttribute('user_id'))
            ->where('intezmeny', '=', $this->getAttribute('intezmeny'))
            ->where('szak', '=', $this->getAttribute('szak'));
        return $query;
    }


    protected $fillable = [
        'allaskereso',
        'intezmeny',
        'szak',
        'vegzettseg',
        'kezdes',
        'vegzes',
        'erintett_targytev'
    ];

    public $timestamps = false;

   

    public function allaskeresoEntity()
    {
        return $this->hasOne(Allaskereso::class, 'allaskereso', 'user_id');
    }
    
}
