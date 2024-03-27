<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllaskeresoTanulmany extends Model
{
    use HasFactory;

    protected $primaryKey = ['allaskereso', 'intezmeny', 'vegzettseg'];
    public $timestamps = false;

    protected $fillable = [
        'allaskereso',
        'intezmeny',
        'szak',
        'vegzettseg',
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

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('allaskereso', '=', $this->getAttribute('user_id'))
            ->where('intezmeny', '=', $this->getAttribute('intezmeny'))
            ->where('szak', '=', $this->getAttribute('szak'));
        return $query;
    }
}
