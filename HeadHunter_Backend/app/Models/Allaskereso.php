<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Allaskereso extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";

    const NEMEK = [
        'nő',
        'férfi'
    ];

    protected $fillable = [
        'user_id',
        'nem',
        'szul_ido',
        'telefonszam',
        'fax',
        'allampolgarsag',
        'jogositvany',
        'szoc_keszseg',
        'fenykep',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public static $rules = [
        'user_id' => 'required',
        'nem' => 'required|in:férfi,nö',
        'szul_ido' => 'required|date',
        'telefonszam' => 'nullable|string',
        'fax' => 'nullable|string',
        'allampolgarsag' => 'nullable|string',
        'jogositvany' => 'nullable|boolean',
        'szoc_keszseg' => 'nullable|longtext',
        'fenykep' => 'nullable|string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
