<?php

namespace App\Http\Controllers;

use App\Models\AllasNyelvtudas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllasNyelvtudasController extends Controller
{
    public function index(){
        
        return AllasNyelvtudas::all();
    }

    public function show($allas,$nyelvkod){
        $allasism = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        return $allasism;
    }

    public function showallas($allas){
        $allasism = AllasNyelvtudas::where('allas', $allas)->get();
        return $allasism;
    }

    public function store(Request $request){
        $allasism = new AllasNyelvtudas();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function update(Request $request, $allas, $nyelvkod){
        $allasism = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function destroy($allas,$nyelvkod){
        $allasism = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        $allasism->delete();
    }

    public function detailedAllasNyelv($allas_id){
        return DB::table('allas_nyelvtudass as an')
            ->join('nyelvtudass as nt', 'an.nyelvtudas','=','nt.nyelvkod')
            ->select('nt.nyelv', 'nt.megnevezes')
            ->where('an.allas', $allas_id)
            ->get();
    }
}
