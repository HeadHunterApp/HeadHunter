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
        'cim',
        'telefonszam',
        'fax',
        'anyanyelv',
        'allampolgarsag',
        'jogositvany',
        'szoc_keszseg',
     
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public static $rules = [
        'user_id' => 'required',
        'nem' => 'required|in:férfi,nő',
        'szul_ido' => 'required|date',
        'cim' => 'required|string',
        'telefonszam' => 'nullable|string',
        'fax' => 'nullable|string',
        'anyanyelv' => 'required|string',
        'allampolgarsag' => 'required|string',
        'jogositvany' => 'nullable|boolean',
        'szoc_keszseg' => 'nullable|longtext',
    ];

    public static $updateRules = [
        'neme' => 'required|in:férfi,nő',
        'szul_ido' => 'required|date',
        'cim' => 'required|string',
        'telefonszam' => 'nullable|string',
        'fax' => 'nullable|string',
        'anyanyelv' => 'required|string',
        'allampolgarsag' => 'required|string',
        'jogositvany' => 'nullable|boolean',
        'szoc_keszseg' => 'nullable|longtext',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
