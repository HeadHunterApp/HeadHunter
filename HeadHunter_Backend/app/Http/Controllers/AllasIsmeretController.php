<?php

namespace App\Http\Controllers;

use App\Models\AllasIsmeret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllasIsmeretController extends Controller
{
    public function index(){
        
        return AllasIsmeret::all();
    }

    public function show($allas,$ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        return $allasism;
    }

    public function showallas($allas){
        $allasism = AllasIsmeret::where('allas', $allas)->get();
        return $allasism;
    }

    public function store(Request $request){
        $allasism = new AllasIsmeret();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function update(Request $request, $allas, $ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function destroy($allas,$ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $allasism->delete();
    }

    public function detailedAllasIsm($allas_id){
        $allasism=DB::table('allas_ismerets as ai')
            ->join('szakmai_ismerets as si', 'ai.szakmai_ismeret', '=', 'si.ismeret_id')
            ->select('si.megnevezes', 'si.szint')
            ->where('ai.allas', $allas_id)
            ->get();
        if ($allasism->isEmpty()) {
                return response()->json(['message' => 'Ehhez az álláshoz nem adtak meg szakmai tudásra vonatkozó elvárást'], 404);
        }
        return $allasism;
    }
}