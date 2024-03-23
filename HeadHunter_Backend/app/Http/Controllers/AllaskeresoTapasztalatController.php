<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTapasztalat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return $aktap;
    }

    public function showallasker($allasker){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)->get();
        if ($aktap->isEmpty()) {
            return response()->json(['message' => 'Korábbi munkahely nem került megadásra'], 404);
        }
        return $aktap;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $signed)->get();
        if ($aktap->isEmpty()) {
            return response()->json(['message' => 'Még egyetlen korábbi munkahelyet sem adtál meg'], 404);
        }
        return $aktap;
    }

    public function store(Request $request){
        $aktap = new AllaskeresoTapasztalat();
        $aktap->fill($request->all());
        $aktap->save();
    }

    public function update(Request $request, $allasker, $cegnev, $pozicio){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $aktap->fill($request->all());
        $aktap->save();
    }

    public function destroy($allasker, $cegnev, $pozicio){
        $aktap = AllaskeresoTapasztalat::where('allaskereso', $allasker)
        ->where('cegnev','=', $cegnev)
        ->where('pozicio','=', $pozicio)
        ->firstOrFail();
        $aktap->delete();
    }
}
