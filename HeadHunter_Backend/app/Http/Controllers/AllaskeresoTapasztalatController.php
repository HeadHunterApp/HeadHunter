<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTapasztalat;
use App\Models\Pozicio;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function showsignedv2(){
        $signed = Auth::user()->user_id;
        $allaskeresoTapasztalatok = AllaskeresoTapasztalat::where('allaskereso', $signed)
            ->get();

        if (!$allaskeresoTapasztalatok) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
        }

        $tapasztalat_datas = array();
        foreach ($allaskeresoTapasztalatok as $tapasztalat) {
            $vegeDatum = $tapasztalat->vegzes ? new DateTime($tapasztalat->vegzes) : new DateTime();
            $kezdesDatum = new DateTime($tapasztalat->kezdes);
            $datumKulonbseg = $vegeDatum->diff($kezdesDatum);
            $datumKulonbsegHonapokban = $datumKulonbseg->y * 12 + $datumKulonbseg->m;

            Log::error("--------TAPASZTALAT LOG:");
            Log::error($tapasztalat);
            Log::error($tapasztalat->pozicioEntity);

            $tapasztalat_datas[] = [
                'idotartam' => $datumKulonbsegHonapokban,
                'kezdes' => $tapasztalat->kezdes,
                'vegzes'=> $tapasztalat->vegzes,
                'cegnev' => $tapasztalat->cegnev,
                'ceg_cim' => $tapasztalat->ceg_cim,
                'teruletMegnevezes'=> $tapasztalat->pozicioEntity->teruletEntity->megnevezes,
                'pozkod' => $tapasztalat->pozicio,
                'pozicio' => $tapasztalat->pozicioEntity->pozicio
            ] ;
        }

        return $tapasztalat_datas;
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

    public function updatesignedv2(Request $request){
        $signed = Auth::user()->user_id;

        $tapasztalat = AllaskeresoTapasztalat::where('allaskereso', $signed)
        ->where('cegnev','=', $request->origCegnev)
        ->where('pozicio','=', $request->origPozkod)
        ->first();

        Log::error("Tapasztalat módosítás / beszúrás log.");
        Log::error($tapasztalat);

        if($tapasztalat)
        {
            Log::error("Módosítok");
            DB::table('allaskereso_tapasztalats')
            ->where('allaskereso','=', $signed)
            ->where('cegnev','=', $request->origCegnev)
            ->where('pozicio','=', $request->origPozkod)
            ->update([
                'cegnev' => $request->cegnev,
                'ceg_cim' => $request->cegcim,
                'kezdes' => $request->kezdes,
                'vegzes' => $request->vegzes,
                'pozicio' => $request->selectedPozicio['value']
            ]);
            
            return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
        }
        else
        {
            Log::error("Újat szúrok be.");

            AllaskeresoTapasztalat::create([
                'allaskereso' => $signed,
                'cegnev' => $request->cegnev,
                'kezdes' => $request->kezdes,
                'vegzes' => $request->vegzes,
                'ceg_cim' => $request->cegcim,
                'pozicio' => $request->selectedPozicio['value']
            ]);
        }
    }

    public function destroy($allasker, $cegnev, $pozicio){ // ez azért marad, hogy az admin is tudjon törölni
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $aktap->delete();
    }

    public function destroySigned(Request $request){ //ez az álláskereső tudja magánál törölni
        $signed = Auth::user()->user_id;
        $cegnev = $request->query('cegnev');
        $pozkod = $request->query('pozkod');

        DB::table('allaskereso_tapasztalats')
        ->where('allaskereso', $signed)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozkod)
        ->delete();
    }
}
