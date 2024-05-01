<?php

namespace App\Http\Controllers;

use App\Models\Allas;
use App\Models\AllasJelentkezo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllasJelentkezoController extends Controller
{
    public function index(){
        
        return AllasJelentkezo::all();
    }

    public function show($allas,$allasker){
        $allasjel = AllasJelentkezo::where('allas', $allas)
        ->where('allaskereso','=', $allasker)
        ->firstOrFail();
        return $allasjel;
    }

    public function showallas($allas){
        $allasjel = AllasJelentkezo::where('allas', $allas)->get();
        return $allasjel;
    }

    public function showallasker($allasker){
        $allasjel = AllasJelentkezo::where('allaskereso', $allasker)->get();
        return $allasjel;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $allasjel=DB::table('allas_jelentkezos as aj')
            ->join('allass as al', 'aj.allas','=','al.allas_id')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'aj.allaskereso','=','u.user_id')
            ->select(
                'aj.allas',
                'm.cegnev',
                'al.megnevezes',
                DB::raw('DATE_FORMAT(aj.created_at, "%Y-%m-%d") as jelentkezes'),
                'aj.statusz',
                DB::raw('DATE_FORMAT(aj.updated_at, "%Y-%m-%d") as frissites')
            )
            ->where('aj.allaskereso', $signed)
            ->get();
        if ($allasjel->isEmpty()) {
                return response()->json(['message' => 'Még egyetlen állásra sem jelentkeztél'], 404);
        }
        return $allasjel;
    }

    public function store(Request $request){
        $request->validate([
            'allas' => 'required|exists:allas,allas_id',
            'allaskereso' => 'required|exists:allaskereso,user_id',
        ]);
        try {
            $allasjel = new AllasJelentkezo();
            $allasjel->fill($request->all());
            $allasjel->save();
            return response()->json(['message' => 'Álláskereső jelentkezése sikeresen mentve'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hiba történt a jelentkezés rögzítése során'], 500);
        }
    }

    public function storesigned($allas_id){
        $allas = Allas::findOrFail($allas_id);
        
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $signed = $user->user_id;
            $allasjel = new AllasJelentkezo();
            $allasjel->allaskereso=$signed;
            $allasjel->allas=$allas->allas_id;
            $allasjel->save();
            return response()->json(['message' => 'Sikeres jelentkezés'], 200);
        }  else {
            return response()->json(['message' => 'Jogosultság probléma'], 401);
        }
    }

    public function update(Request $request, $allas, $allasker){
        $allasjel = AllasJelentkezo::where('allas', $allas)
        ->where('allaskereso','=', $allasker)
        ->firstOrFail();
        $allasjel->fill($request->all());
        $allasjel->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function destroy($allas,$allasker){
        $allasjel = AllasJelentkezo::where('allas', $allas)
        ->where('allaskereso','=', $allasker)
        ->firstOrFail();
        $allasjel->delete();
    }

    public function detailedJelentkezokAll(){
        $allasjel=DB::table('allas_jelentkezos as aj')
            ->join('allass as al', 'aj.allas','=','al.allas_id')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'aj.allaskereso','=','u.user_id')
            ->select(
                'aj.allas',
                'm.cegnev',
                'al.megnevezes',
                't.megnevezes',
                'p.pozicio',
                'aj.allaskereso',
                'u.nev',
                DB::raw('DATE_FORMAT(aj.created_at, "%Y-%m-%d") as jelentkezes'),
                'aj.statusz',
                DB::raw('DATE_FORMAT(aj.updated_at, "%Y-%m-%d") as frissites')
            )
            ->get();
        return $allasjel;
    }

    public function detailedAllasJelentkezok($allas){
        $allasjel=DB::table('allas_jelentkezos as aj')
            ->join('allass as al', 'aj.allas','=','al.allas_id')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'aj.allaskereso','=','u.user_id')
            ->select(
                'aj.allas',
                'm.cegnev',
                'al.megnevezes',
                't.megnevezes',
                'p.pozicio',
                'aj.allaskereso',
                'u.nev',
                DB::raw('DATE_FORMAT(aj.created_at, "%Y-%m-%d") as jelentkezes'),
                'aj.statusz',
                DB::raw('DATE_FORMAT(aj.updated_at, "%Y-%m-%d") as frissites')
            )
            ->where('aj.allas', $allas)
            ->get();
        if ($allasjel->isEmpty()) {
                return response()->json(['message' => 'Erre az állásra még senki sem jelentkezett'], 404);
        }
        return $allasjel;
    }

    public function detailedAllaskerJelentkezesek($allasker){
        $allasjel=DB::table('allas_jelentkezos as aj')
            ->join('allass as al', 'aj.allas','=','al.allas_id')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'aj.allaskereso','=','u.user_id')
            ->select(
                'aj.allaskereso',
                'u.nev',
                'aj.allas',
                'm.cegnev',
                'al.megnevezes',
                't.megnevezes',
                'p.pozicio',
                DB::raw('DATE_FORMAT(aj.created_at, "%Y-%m-%d") as jelentkezes'),
                'aj.statusz',
                DB::raw('DATE_FORMAT(aj.updated_at, "%Y-%m-%d") as frissites')
            )
            ->where('aj.allaskereso', $allasker)
            ->get();
        if ($allasjel->isEmpty()) {
                return response()->json(['message' => 'Ez az álláskereső még egyetlen pályázatot sem nyújtott be'], 404);
        }
        return $allasjel;
    }

    
}
