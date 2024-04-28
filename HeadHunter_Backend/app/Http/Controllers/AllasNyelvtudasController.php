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
        $allasnyelv = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        return $allasnyelv;
    }

    public function showallas($allas){
        $allasnyelv = AllasNyelvtudas::where('allas', $allas)->get();
        return $allasnyelv;
    }

    public function store(Request $request){
        $allasnyelv = new AllasNyelvtudas();
        $allasnyelv->fill($request->all());
        $allasnyelv->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allas, $nyelvkod){
        $allasnyelv = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        $allasnyelv->fill($request->all());
        $allasnyelv->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function destroy($allas,$nyelvkod){
        $allasnyelv = AllasNyelvtudas::where('allas', $allas)
        ->where('nyelvtudas','=', $nyelvkod)
        ->firstOrFail();
        $allasnyelv->delete();
    }

    public function detailedAllasNyelv($allas_id){
        $allasnyelv=DB::table('allas_nyelvtudass as an')
            ->join('nyelvtudass as nt', 'an.nyelvtudas','=','nt.nyelvkod')
            ->select(
                'nt.nyelv',
                DB::raw('case 
                when nt.szint = "A1" THEN "kezdő"
                when nt.szint = "A2" THEN "alapszint"
                when nt.szint = "B1" THEN "küszöbszint"
                when nt.szint = "B2" THEN "társalgási szint"
                when nt.szint = "C1" THEN "tárgyalóképes szint"
                when nt.szint = "C2" THEN "anyanyelvi szint"
                else "egyéb"
                end
                as megnevezes'),//egyéb csak egyedi hibánál fordulhat elő
                )
            ->where('an.allas', $allas_id)
            ->get();
        if ($allasnyelv->isEmpty()) {
                return response()->json(['message' => 'Ehhez az álláshoz nem adtak meg nyelvtudásra vonatkozó elvárást'], 404);
        }
        return $allasnyelv;
    }
}
