<?php

namespace App\Http\Controllers;

use App\Models\AllasTapasztalat;
use Illuminate\Http\Request;

class AllasTapasztalatController extends Controller
{
    public function index(){
        
        return AllasTapasztalat::all();
    }

    public function show($allas){
        return AllasTapasztalat::findOrFail($allas);
    }

    public function store(Request $request){
        $allastap = new AllasTapasztalat();
        $allastap->fill($request->all());
        $allastap->save();
    }

    public function update(Request $request, $allas){
        $allastap = AllasTapasztalat::findOrFail($allas);
        $allastap->fill($request->all());
        $allastap->save();
    }

    public function destroy($allas){
        AllasTapasztalat::findOrFail($allas)->delete();
    }
}
