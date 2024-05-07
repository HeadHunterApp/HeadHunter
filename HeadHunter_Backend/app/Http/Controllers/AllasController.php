<?php

namespace App\Http\Controllers;

use App\Models\Allas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllasController extends Controller
{
    public function index(){
        try {
            return Allas::all();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'munkaltato' => 'required|integer',
            'megnevezes' => 'required|string',
            'pozicio' => 'required|string',
            'statusz' => 'required|string',
            'leiras' => 'required|string',
            'fejvadasz' => 'required|integer',
        ]);

        $allas = Allas::create($validatedData);

        return response()->json(['allas' => $allas], 201);
    }

    public function show($id)
    {
        $allas = Allas::find($id);

        if (!$allas) {
            return response()->json(['error' => 'Az állás nem található'], 404);
        }

        return $allas;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'munkaltato' => 'integer|nullable',
            'megnevezes' => 'string|nullable',
            'pozicio' => 'string|nullable',
            'statusz' => 'string|nullable',
            'leiras' => 'string|nullable',
            'fejvadasz' => 'integer|nullable',
        ]);
    
        $allas = Allas::find($id);
    
        if (!$allas) {
            return response()->json(['error' => 'Az állás nem található'], 404);
        }
    
        try {
            $allas->update($validatedData);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    
        return response()->json(['allas' => $allas], 200);
    }
    


    public function destroy($id)
    {
        $allas = Allas::find($id);

        if (!$allas) {
            return response()->json(['error' => 'Az állás nem található'], 404);
        }

        $allas->delete();

        return response()->json(['message' => 'Az állás sikeresen törölve lett'], 200);
    }

    public function detailedAllas($allas_id)
{
    $query = DB::table('allass as al')

        ->join('munkaltatos as m', 'al.munkaltato', '=', 'm.munkaltato_id')
        ->join('pozicios as p', 'al.pozicio', '=', 'p.pozkod')
        ->join('terulets as t', 'p.terulet', '=', 't.terulet_id')
        ->join('users as u', 'al.fejvadasz', '=', 'u.user_id')
        ->where('al.allas_id', $allas_id);
        
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
    
    if (Auth::check() && (Auth::user()->jogosultsag === 'admin' || Auth::user()->jogosultsag === 'fejvadász')) {
        $query->addSelect('al.fejvadasz_id', 'u.nev as fejvadasz');
    }
    
    $result = $query->first();
    return $result;
}


    public function shortAllasAll()
    {
        $query = DB::table('allass as al')
            ->join('munkaltatos as m', 'al.munkaltato', '=', 'm.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio', '=', 'p.pozkod')
            ->join('terulets as t', 'p.terulet', '=', 't.terulet_id')
            ->join('users as u', 'al.fejvadasz', '=', 'u.user_id')
            ->select(
                'al.allas_id',
                'm.cegnev',
                'al.megnevezes',
                'p.pozicio', // beleraktam a pozicitót hogy azt is visszaadja
                'al.leiras',
                'al.statusz',
            )
            ->get();

        return $query;
    }
}
