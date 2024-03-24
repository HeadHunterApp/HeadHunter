<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoNyelvtudas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)->get();
        if ($aknyelv->isEmpty()) {
            return response()->json(['message' => 'Nyelvtudás nem került megadásra'], 404);
        }
        return $aknyelv;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $signed)->get();
        if ($aknyelv->isEmpty()) {
            return response()->json(['message' => 'Még nem adtál meg a nyelvtudásodra vonatkozó adatot'], 404);
        }
        return $aknyelv;
    }


    public function store(Request $request){
        $aknyelv = new AllaskeresoNyelvtudas();
        $aknyelv->fill($request->all());
        $aknyelv->save();
    }

    public function update(Request $request, $allasker, $nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->fill($request->all());
        $aknyelv->save();
    }

    public function destroy($allasker,$nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->delete();
    }
}
