<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoNyelvtudas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllaskeresoNyelvtudasController extends Controller
{
    public function index(){
        
        return AllaskeresoNyelvtudas::all();
    }

    public function show($allasker,$nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        return $aknyelv;
    }

    public function showallasker($allasker){
        $aknyelv = DB::table('allaskereso_nyelvtudas as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $allasker)
        ->select(
            'nt.nyelv',
            'nt.szint',
            'nt.megnevezes',
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();
        if ($aknyelv->isEmpty()) {
            return response()->json(['message' => 'Nyelvtudás nem került megadásra'], 404);
        }
        return $aknyelv;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aknyelv = DB::table('allaskereso_nyelvtudas as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $signed)
        ->select(
            'nt.nyelv',
            'nt.szint',
            'nt.megnevezes',
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();
        if ($aknyelv->isEmpty()) {
            return response()->json(['message' => 'Még nem adtál meg a nyelvtudásodra vonatkozó adatot'], 404);
        }
        return $aknyelv;
    }


    public function store(Request $request){
        $aknyelv = new AllaskeresoNyelvtudas();
        $aknyelv->fill($request->all());
        $aknyelv->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allasker, $nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->fill($request->all());
        $aknyelv->save();
        return response()->json(['message' => 'Nyelvtudásra vonatkozó adatok frissítve'], 200);
    }

    public function updatesigned(Request $request, $nyelvtudas){
        $signed = Auth::user()->user_id;
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $signed)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->fill($request->all());
        $aknyelv->save();
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);

    }

    public function destroy($allasker,$nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->delete();
    }
}
