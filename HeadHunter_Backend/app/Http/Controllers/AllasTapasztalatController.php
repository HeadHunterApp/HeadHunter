<?php

namespace App\Http\Controllers;

use App\Models\AllasTapasztalat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllasTapasztalatController extends Controller
{
    public function index(){
        
        return AllasTapasztalat::all();
    }

    public function show($allas){
        return AllasTapasztalat::findOrFail($allas);
    }

    public function store(Request $request){
        $allastap = new AllasTapasztalat();
        $allastap->fill($request->all());
        $allastap->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allas){
        $allastap = AllasTapasztalat::findOrFail($allas);
        $allastap->fill($request->all());
        $allastap->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function destroy($allas){
        AllasTapasztalat::findOrFail($allas)->delete();
    }

    public function detailedAllasTap($allas_id){
        $allastap=DB::table('allas_tapasztalats as at')
            ->join('tapasztalat_idos as ti', 'at.tapasztalat_ido','=','ti.tapasztalat_id')
            ->join('pozicios as p', 'at.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->select('t.megnevezes', 'p.pozicio', 'ti.leiras')
            ->where('ai.allas', $allas_id)
            ->get();
        if ($allastap->isEmpty()) {
                return response()->json(['message' => 'Ehhez az álláshoz nem adtak meg korábbi munkatapasztalatra vonatkozó elvárást'], 404);
        }
        return $allastap;
    }
}
