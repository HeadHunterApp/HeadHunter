<?php

namespace App\Http\Controllers;


use App\Models\Allas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllasController extends Controller
{
      public function index(){
        $allas = response()->json(Allas::all());
        return $allas;
    }

    public function store(Request $request)
    {
        // Validáció hozzáadása a bejövő kéréshez
        $validatedData = $request->validate([
            'munkaltato' => 'required|string',
            'megnevezes' => 'required|string',
            'pozicio' => 'required|string',
            'statusz' => 'required|string',
            'leiras' => 'required|string',
            'fejvadasz' => 'required|string',
        ]);
    
        // Új Allas modell létrehozása és feltöltése a validált adatokkal
        $allas = new Allas();
        $allas->munkaltato = $validatedData['munkaltato'];
        $allas->megnevezes = $validatedData['megnevezes'];
        $allas->pozicio = $validatedData['pozicio'];
        $allas->statusz = $validatedData['statusz'];
        $allas->leiras = $validatedData['leiras'];
        $allas->fejvadasz = $validatedData['fejvadasz'];
        $allas->save();
    
        // Visszatérési érték a mentett állás objektummal
        return response()->json(['allas' => $allas], 201);
    }

 
    public function show($id)
    {
        $allas = Allas::where('allas_id', $id)->first();
        return $allas;
    }

    public function update(Request $request,$id)
    {
        $allas = $this->show($id);
        $allas->fill($request->all());
        $allas->save();
    }

    public function destroy($id){
        Allas::findOrFail($id)->delete();
    }    
  
    public function detailedAllas($allas_id){
        $query = DB::table('allass as al')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'al.fejvadasz','=','u.user_id')
            ->where('al.allas_id',$allas_id);
            if (Auth::check() && (Auth::user()->jogosultsag === 'admin' || Auth::user()->jogosultsag === 'fejvadász')) {
                $query->select(
                    'al.allas_id',
                    'm.cegnev',
                    'al.megnevezes',
                    't.megnevezes as terulet',
                    'p.pozicio',
                    'al.leiras',
                    'al.statusz',
                    DB::raw('DATE_FORMAT(al.created_at, "%Y-%m-%d") as datum'),
                    'al.fejvadasz as fejvadasz_id',
                    'u.nev as fejvadasz'
                );
            } else {
                $query->select(
                'al.allas_id',
                'm.cegnev',
                'al.megnevezes',
                't.megnevezes as terulet',
                'p.pozicio',
                'al.leiras',
                'al.statusz',
                DB::raw('DATE_FORMAT(al.created_at, "%Y-%m-%d") as datum')
                );
            }
        $result = $query->first();
        return $result; 
    }
    
    public function shortAllasAll(){
        $query = DB::table('allass as al')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'al.fejvadasz','=','u.user_id')
            ->select(
                'al.allas_id',
                'm.cegnev',
                'al.megnevezes',
                'al.leiras',
                'al.statusz',
                )
            ->get();
            return $query;
    }

}
