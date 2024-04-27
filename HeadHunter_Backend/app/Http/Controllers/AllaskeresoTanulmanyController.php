<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTanulmany;
use App\Models\Vegzettseg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllaskeresoTanulmanyController extends Controller
{
    public function index(){
        return AllaskeresoTanulmany::all();
    }

    public function show($allasker, $intezmeny, $szak){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        return $aktan;
    }

    public function showallasker($allasker){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
            ->select(
                'intezmeny',
                'szak',
                'vegzettseg',
                'kezdes',
                'vegzes',
                'erintett_targytev'
            )
            ->get();
        if ($aktan->isEmpty()) {
            return response()->json(['message' => 'Tanulmányokra vonatkozó adat nem került megadásra'], 404);
        }
        return $aktan;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
            ->where('allaskereso', $signed)
            ->first();
/*             ->select(
                'intezmeny',
                'szak',
                'vegzettseg',
                'kezdes',
                'vegzes',
                'erintett_targytev'
            )
            ->get(); */

        if (!$aktan) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 200);
        }

        $vegeDatum = $aktan->vegzes ?? date('Y-m-d');
        $result = [
            'idotartam' => $vegeDatum - $aktan->kezdes,
            'kezdes' => $aktan->kezdes,
            'vegzes'=> $aktan->vegzes,
            'intezmeny' => $aktan->intezmeny,
            'erintett_targytev' => $aktan->erintett_targytev,
            'szak'=>$aktan->szak,
            'szoc_keszseg'=> $aktan->allaskeresoEntity->szoc_keszseg,
        ];

        return $result;
    }

    public function showsignedv2(){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
            ->where('allaskereso', $signed)
            ->first();
/*             ->select(
                'intezmeny',
                'szak',
                'vegzettseg',
                'kezdes',
                'vegzes',
                'erintett_targytev'
            )
            ->get(); */

        if (!$aktan) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 200);
        }

        $vegeDatum = $aktan->vegzes ?? date('Y-m-d');
        $result = [
            'idotartam' => $vegeDatum - $aktan->kezdes,
            'kezdes' => $aktan->kezdes,
            'vegzes'=> $aktan->vegzes,
            'intezmeny' => $aktan->intezmeny,
            'erintett_targytev' => $aktan->erintett_targytev,
            'szak'=>$aktan->szak,
            'szoc_keszseg'=> $aktan->allaskeresoEntity->szoc_keszseg,
        ];

        return $result;
    }

    public function store(Request $request){
        $aktan = new AllaskeresoTanulmany();
        $aktan->fill($request->all());
        $aktan->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allasker, $intezmeny, $szak){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        $aktan->fill($request->all());
        $aktan->save();
        return response()->json(['message' => 'Tanulmányokra vonatkozó adatok frissítve'], 200);
    }

    public function updatesigned(Request $request, $intezmeny, $szak){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
        ->where('allaskereso','=', $signed)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();

        //$aktan->fill($request->all());
        $aktan->intezmeny = $request->intezmeny;
        $aktan->szak = $request->szakkepesites;
        //$aktan->vegzettseg = $request->vegzettsegId;   //TODO: --> nem látom FE-n
        $aktan->kezdes = $request->oktkezdes;
        $aktan->vegzes = $request->oktvegzes;
        $aktan->erintett_targytev = $request->fotargy;

        $aktan->save();

        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function updatesignedv2(Request $request, $intezmeny, $szak){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
        ->where('allaskereso','=', $signed)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();

        //$aktan->fill($request->all());
        $aktan->intezmeny = $request->intezmeny;
        $aktan->szak = $request->szakkepesites;
        //$aktan->vegzettseg = $request->vegzettsegId;   //TODO: --> nem látom FE-n
        $aktan->kezdes = $request->oktkezdes;
        $aktan->vegzes = $request->oktvegzes;
        $aktan->erintett_targytev = $request->fotargy;

        $aktan->save();

        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function destroy($allasker, $intezmeny, $szak){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        $aktan->delete();
    }
}
