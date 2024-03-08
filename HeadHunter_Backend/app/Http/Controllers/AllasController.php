<?php

namespace App\Http\Controllers;

use App\Models\Allas;
use Illuminate\Http\Request;

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
        $allas->terulet=$request->terulet;
        $allas->statusz=$request->statusz;
        $allas->leiras=$request->leiras;
        $allas->datum=$request->datum;
        $allas->fejvadasz=$request->fejvadasz;
        $allas->save();
    }

 
    public function show ($id)
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
  
}
