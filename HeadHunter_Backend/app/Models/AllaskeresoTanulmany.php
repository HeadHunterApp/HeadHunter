<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoTanulmany extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->
            getAttribute('user_id'))
            ->where('intezmeny', '=', $this->
            getAttribute('intezmeny'))
            ->where('vegzettseg', '=', $this->
            getAttribute('sorszam'));


        return $query;
    }

    protected $primaryKey=['allaskereso','intezmeny','vegzettseg'];
    
    protected $fillable = [
        'allaskereso',
        'intezmeny',
        'vegzettseg',
        'szak',
        'kezdes',
        'vegzes',
        'erintett_targytev'
    ];

    //I preferred Carbon, not casting

    public function setKezdesAttribute($value)
    {
        $formatteddate = Carbon::parse($value)->format('Y/m');
        $this->attributes['kezdes'] = $formatteddate;
        $this->attributes['vegzes'] = $formatteddate;
    }
}
