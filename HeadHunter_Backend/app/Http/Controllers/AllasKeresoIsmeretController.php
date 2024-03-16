<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllasKeresoIsmeretController extends Controller
{
    public function index(){
        return AllaskeresoIsmeret::all();
    }

    public function show($id){
        $allaskeresoismeret = User::where('user_id', $id)->first(['nev', 'email']);
        $allaskeresoismeret= Allaskereso::where('user_id', $id)->findOrFail();
        return $allaskeresoismeret;
    }

    public function store(Request $request){
        $allaskereso=new Allaskereso();
        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function update(Request $request, $id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function destroy($id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->delete();
    }
}