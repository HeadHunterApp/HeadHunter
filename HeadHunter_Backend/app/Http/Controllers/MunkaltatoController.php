<?php

namespace App\Http\Controllers;

use App\Models\Munkaltato;
use Illuminate\Http\Request;

class MunkaltatoController extends Controller
{
    public function index(){
        
        return Munkaltato::all();
    }

    public function show($id){
        return Munkaltato::findOrFail($id);
    }

    public function store(Request $request){
        $munkaltato = new Munkaltato();
        $munkaltato->cegnev = $request->input('cegnev');
        $munkaltato->szekhely = $request->input('szekhely');
        $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
        $munkaltato->telefonszam = $request->input('telefonszam');
        $munkaltato->email = $request->input('email');
        $munkaltato->save();
    }

    public function update(Request $request, $id){
        $munkaltato = Munkaltato::findOrFail($id);
        $munkaltato->cegnev = $request->input('cegnev');
        $munkaltato->szekhely = $request->input('szekhely');
        $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
        $munkaltato->telefonszam = $request->input('telefonszam');
        $munkaltato->email = $request->input('email');
        $munkaltato->save();
    }

    public function destroy($id){
        Munkaltato::findOrFail($id)->delete();
    }
}
