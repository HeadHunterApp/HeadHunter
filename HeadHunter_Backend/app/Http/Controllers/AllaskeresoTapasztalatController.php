<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTapasztalat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllaskeresoTapasztalatController extends Controller
{
    public function index(){
        return AllaskeresoTapasztalat::all();
    }

    public function show($allasker, $cegnev, $pozicio){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $vegeDatum = $aktap->vegzes ?? date('Y-m-d');
        $result = [
            'idotartam' => $vegeDatum - $aktap->kezdes,
            'allaskeresotapasztalat'=> $aktap,
            'terulet'=> $aktap->terulet
        ];

        return $result;
    }

    public function showallasker($allasker){
        $aktap = DB::table('allaskereso_tapasztalats as akt')
        ->join('pozicios as p', 'at.pozicio','=','p.pozkod')
        ->join('terulets as t', 'p.terulet','=','t.terulet_id')
        ->select(
            'akt.cegnev',
            'akt.ceg_cim',
            't.megnevezes',
            'p.pozicio',
            'ti.leiras',
            'akt.kezdes',
            'akt.vegzes')
        ->where('allaskereso', $allasker)->get();
        if ($aktap->isEmpty()) {
            return response()->json(['message' => 'Korábbi munkahely nem került megadásra'], 404);
        }
        return $aktap;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aktap = DB::table('allaskereso_tapasztalats as akt')
            ->join('pozicios as p', 'akt.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->select(
                'akt.cegnev',
                'akt.ceg_cim',
                't.megnevezes',
                'p.pozicio',
                'akt.kezdes',
                'akt.vegzes')
            ->where('allaskereso', $signed)
            ->get();

        if ($aktap->isEmpty()) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még egyetlen korábbi munkahelyet sem adtál meg'], 404);
            return response()->json(['message' => 'Még egyetlen korábbi munkahelyet sem adtál meg'], 200);
        }

        return $aktap;
    }

    public function store(Request $request){
        $aktap = new AllaskeresoTapasztalat();
        $aktap->fill($request->all());
        $aktap->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    
    public function storesigned(Request $request){
        $signed = Auth::user()->user_id;
        $aktap = new AllaskeresoTapasztalat();
        $aktap->allaskereso=$signed;
        $aktap->fill($request->all());
        $aktap->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allasker, $cegnev, $pozicio){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $aktap->fill($request->all());
        $aktap->save();
        return response()->json(['message' => 'Munkatapasztalatok frissítve'], 200);
    }

    public function updatesigned(Request $request, $cegnev, $pozicio){
        $signed = Auth::user()->user_id;
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $signed)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();  
        if (!$aktap) {
            return response()->json(['error' => 'Hiba történt'], 404);
        }
        $aktap->cegnev = $request->cegnev;
        $aktap->ceg_cim = $request->ceg_cim;
        $aktap->pozicio = $request->pozicio;
        $aktap->kezdes = $request->kezdes;
        $aktap->vegzes = $request->vegzes;  

        $aktap->save();
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function destroy($allasker, $cegnev, $pozicio){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $aktap->delete();
    }
}
