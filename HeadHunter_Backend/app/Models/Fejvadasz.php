<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fejvadasz extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";

    protected $fillable = [
        'user_id',
        'telefonszam',
       
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public static $rules = [
        'user_id' => 'required',
        'telefonszam' => 'nullable|string',
      
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fejvadaszTerulet()
    {
        return $this->belongsToMany(FejvadaszTerulet::class, 'fejvadasz', 'user_id');
    }
}
