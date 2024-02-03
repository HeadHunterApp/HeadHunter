<?php

namespace App\Http\Controllers;

use App\Models\TapasztalatIdo;
use Illuminate\Http\Request;

class TapasztalatIdoController extends Controller
{
    public function index(){
        
        return TapasztalatIdo::all();
    }

    public function show($id){
        return TapasztalatIdo::findOrFail($id);
    }

    public function store(Request $request){
        $tapasztalatido = new TapasztalatIdo();
        $tapasztalatido->leiras = $request->input('leiras');
        $tapasztalatido->save();
    }

    public function update(Request $request, $id){
        $tapasztalatido = TapasztalatIdo::findOrFail($id);
        $tapasztalatido->leiras = $request->input('leiras');
        $tapasztalatido->save();
    }

    public function destroy($id){
        TapasztalatIdo::findOrFail($id)->delete();
    }
}
