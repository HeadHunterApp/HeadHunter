<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTapasztalat;
use Illuminate\Http\Request;

class AllaskeresoTapasztalatController extends Controller
{
    public function index(){
        return AllaskeresoTapasztalat::all();
    }

    public function show($allasker, $cegnev, $pozicio){
        $akism = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        return $akism;
    }

    public function showallasker($allasker){
        $akism = AllaskeresoTapasztalat::where('allaskereso', $allasker)->get();
        return $akism;
    }

    public function store(Request $request){
        $akism = new AllaskeresoTapasztalat();
        $akism->fill($request->all());
        $akism->save();
    }

    public function update(Request $request, $allasker, $cegnev, $pozicio){
        $akism = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $akism->fill($request->all());
        $akism->save();
    }

    public function destroy($allasker, $cegnev, $pozicio){
        $akism = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $akism->delete();
    }
}
