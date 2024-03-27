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
        $allas = new Allas();
        $allas->munkaltato = $request->munkaltato;
        $allas->megnevezes = $request->megnevezes;
        $allas->pozicio=$request->pozicio;
        //$allas->terulet=$request->terulet;
        $allas->statusz=$request->statusz;
        $allas->leiras=$request->leiras;
        $allas->datum=$request->datum;
        $allas->fejvadasz=$request->fejvadasz;
        $allas->save();
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
        $query = DB::table('allas as al')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'al.fejvadasz','=','u.user_id')
            ->select(
                'al.allas_id',
                'm.cegnev',
                'al.megnevezes',
                't.megnevezes',
                'p.pozicio',
                'al.leiras',
                'al.statusz',
                'al.datum'
                )
            ->where('al.allas_id',$allas_id)
            ->get();
            if (Auth::check() && (Auth::user()->jogosultsag === 'admin' || Auth::user()->jogosultsag === 'fejvadasz')) {
                $query->addSelect('al.fejvadasz_id', 'u.nev');
            }
            return $query;
    }
    
    public function shortAllasAll(){
        $query = DB::table('allas as al')
            ->join('munkaltatos as m', 'al.munkaltato','=','m.munkaltato_id')
            ->join('pozicios as p', 'al.pozicio','=','p.pozkod')
            ->join('terulets as t', 'p.terulet','=','t.terulet_id')
            ->join('users as u', 'al.fejvadasz','=','u.user_id')
            ->select(
                'm.cegnev',
                'al.megnevezes',
                'al.leiras',
                'al.statusz',
                )
            ->get();
            return $query;
    }

}
