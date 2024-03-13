<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllaskeresoNyelvtudasController extends Controller
{
    public function index(){
        
        return AllaskerestoNyelvtudas::all();
    }

    public function show($allasker,$nyelvtudas){
        $aknyelv = AllaskerestoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        return $aknyelv;
    }

    public function showallasker($allasker){
        $aknyelv = AllaskerestoNyelvtudas::where('allaskereso', $allasker)->get();
        return $aknyelv;
    }

    public function store(Request $request){
        $aknyelv = new AllaskerestoNyelvtudas();
        $aknyelv->fill($request->all());
        $aknyelv->save();
    }

    public function update(Request $request, $allasker, $nyelvtudas){
        $aknyelv = AllaskerestoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->fill($request->all());
        $aknyelv->save();
    }

    public function destroy($allasker,$nyelvtudas){
        $aknyelv = AllaskerestoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->delete();
    }
}
