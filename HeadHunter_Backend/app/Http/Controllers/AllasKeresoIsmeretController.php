<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\AllaskeresoIsmeret;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllaskeresoIsmeretController extends Controller
{
    public function index(){
        return AllaskeresoIsmeret::all();
    }

    public function show($allasker,$ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        return $akism;
    }

    public function showallasker($allasker){
        $akism = AllaskeresoIsmeret::join('SzakmaiIsmeret as si', 'AllaskeresoIsmeret.szakmai_ismeret', '=', 'si.ismeret_id')
        ->where('allaskereso', $allasker)
        ->select('si.megnevezes', 'si.szint')
        //select elágazás adminhoz, hogy lássa az id-ket!
        ->get();
        if ($akism->isEmpty()) {
            return response()->json(['message' => 'Szakmai ismeret nem került megadásra'], 404);
        }
        return $akism;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $akism = AllaskeresoIsmeret::join('SzakmaiIsmeret as si', 'AllaskeresoIsmeret.szakmai_ismeret', '=', 'si.ismeret_id')
        ->where('allaskereso', $signed)
        ->select('si.megnevezes', 'si.szint')
        ->get();
        if ($akism->isEmpty()) {
            return response()->json(['message' => 'Még egyetlen szakmai ismeretet sem adtál meg'], 404);
        }
        return $akism;
    }

    public function store(Request $request){
        $akism = new AllaskeresoIsmeret();
        $akism->fill($request->all());
        $akism->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);

    }

    public function update(Request $request, $allasker, $ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $akism->fill($request->all());
        $akism->save();
        return response()->json(['message' => 'Szakmai ismeretek frissítve'], 200);
    }

    public function updatesigned(Request $request, $ismeret){
        $signed = Auth::user()->user_id;
        $akism = AllaskeresoIsmeret::where('allaskereso', $signed)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $akism->fill($request->all());
        $akism->save();
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }


    public function destroy($allasker,$ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $akism->delete();
    }
}