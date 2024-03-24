<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTanulmany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllaskeresoTanulmanyController extends Controller
{
    public function index(){
        return AllaskeresoTanulmany::all();
    }

    public function show($allasker, $intezmeny, $vegzettseg){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        return $aktan;
    }

    public function showallasker($allasker){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)->get();
        if ($aktan->isEmpty()) {
            return response()->json(['message' => 'Tanulmányokra vonatkozó adat nem került megadásra'], 404);
        }
        return $aktan;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aktan = AllaskeresoTanulmany::where('allaskereso', $signed)->get();
        if ($aktan->isEmpty()) {
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
        }
        return $aktan;
    }

    public function store(Request $request){
        $aktan = new AllaskeresoTanulmany();
        $aktan->fill($request->all());
        $aktan->save();
    }

    public function update(Request $request, $allasker, $intezmeny, $vegzettseg){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        $aktan->fill($request->all());
        $aktan->save();
    }

    public function destroy($allasker, $intezmeny, $vegzettseg){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('vegzettseg','=', $vegzettseg)
        ->firstOrFail();
        $aktan->delete();
    }
}
