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
        // $munkaltato->cegnev = $request->input('cegnev');
        // $munkaltato->szekhely = $request->input('szekhely');
        // $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
        // $munkaltato->telefonszam = $request->input('telefonszam');
        // $munkaltato->email = $request->input('email');
        $munkaltato->fill($request->all());
        $munkaltato->save();
        return response()->json(['message' => 'Új munkáltató rögzítve'], 200);
    }

    public function update(Request $request, $id){
        $munkaltato = Munkaltato::findOrFail($id);
        // $munkaltato->cegnev = $request->input('cegnev');
        // $munkaltato->szekhely = $request->input('szekhely');
        // $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
        // $munkaltato->telefonszam = $request->input('telefonszam');
        // $munkaltato->email = $request->input('email');
        $munkaltato->fill($request->all());
        $munkaltato->save();
        return response()->json(['message' => 'Munkáltató adatai sikeresen frissítve'], 200); 
    }

    public function destroy($id){
        Munkaltato::findOrFail($id)->delete();
    }
    
}
