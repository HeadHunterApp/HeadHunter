<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTanulmany;
use Illuminate\Http\Request;

class AllaskeresoTanulmanyController extends Controller
{
    public function index(){
        return AllaskeresoTanulmany::all();
    }

    public function show($allasker, $intezmeny, $vegzettseg){
        $akism = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        return $akism;
    }

    public function showallasker($allasker){
        $akism = AllaskeresoTanulmany::where('allaskereso', $allasker)->get();
        return $akism;
    }

    public function store(Request $request){
        $akism = new AllaskeresoTanulmany();
        $akism->fill($request->all());
        $akism->save();
    }

    public function update(Request $request, $allasker, $intezmeny, $vegzettseg){
        $akism = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        $akism->fill($request->all());
        $akism->save();
    }

    public function destroy($allasker, $intezmeny, $vegzettseg){
        $akism = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        $akism->delete();
    }
}
