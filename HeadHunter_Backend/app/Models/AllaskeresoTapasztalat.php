<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoTapasztalat extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->
            getAttribute('user_id'))
            ->where('cegnev', '=', $this->
            getAttribute('cegnev'))
            ->where('pozicio', '=', $this->
            getAttribute('pozkod'));


        return $query;
    }   

    
    protected $fillable = [
        'allaskereso',
        'cegnev',
        'pozicio',
        'kezdes',
        'vegzes'
    ];
    

    public function setKezdesAttribute($value)
    {
        $this->attributes['kezdes'] = Carbon::parse($value)->format('Y/m');
    }

    public function setVegzesAttribute($value)
    {
        $this->attributes['vegzes'] = Carbon::parse($value)->format('Y/m');
    }
    
}
