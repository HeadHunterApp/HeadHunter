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
            getAttribute('pozicio'));


        return $query;
    }   

    
    protected $fillable = [
        'allaskereso',
        'cegnev',
        'ceg_cim',
        'pozicio',
        'kezdes',
        'vegzes'
    ];
    
    //I preferred Carbon, not casting

    public function setDateAttributes($value)
    {
        $formatteddate = Carbon::parse($value)->format('Y/m');
        $this->attributes['kezdes'] = $formatteddate;
        $this->attributes['vegzes'] = $formatteddate;
    }

    public $timestamps = false;
    
    public function pozicioEntity()
    {
        return $this->hasOne(Pozicio::class, 'pozkod', 'pozicio');
    }
}
