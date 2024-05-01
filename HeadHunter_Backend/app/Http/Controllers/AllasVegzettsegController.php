<?php

namespace App\Http\Controllers;

use App\Models\AllasVegzettseg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllasVegzettsegController extends Controller
{
    public function index(){
        
        return AllasVegzettseg::all();
    }

    public function show($allas){
        return AllasVegzettseg::findOrFail($allas);
    }

    public function store(Request $request){
        $allasvegz = new AllasVegzettseg();
        $allasvegz->fill($request->all());
        $allasvegz->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allas){
        $allasvegz = AllasVegzettseg::findOrFail($allas);
        $allasvegz->fill($request->all());
        $allasvegz->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function destroy($allas){
        AllasVegzettseg::findOrFail($allas)->delete();
    }

    public function detailedAllasVegz($allas_id){
        $allasvegz=DB::table('allas_vegzettsegs as av')
            ->join('vegzettsegs as v', 'av.vegzettseg','=','v.vegzettseg_id')
            ->select('v.megnevezes')
            ->where('av.allas', $allas_id)
            ->first();
        if ($allasvegz === null) {
            return response()->json(['message' => 'Ehhez az álláshoz nem adtak meg iskolai végzettségre vonatkozó elvárást'], 404);
        }
        return $allasvegz;
    }
}
