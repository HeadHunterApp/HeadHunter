<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoNyelvtudas;
use Illuminate\Http\Request;

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
