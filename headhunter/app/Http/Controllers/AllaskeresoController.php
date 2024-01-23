<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use Illuminate\Http\Request;

class AllaskeresoController extends Controller
{
    public function index(){
        
        return Allaskereso::all();
    }

    public function show($id){
        return Allaskereso::findOrFail($id);
    }

    public function store(Request $request){
        $allaskereso = new Allaskereso();
        $allaskereso->nev = $request->input('nev');
        $allaskereso->nem = $request->input('nem');
        $allaskereso->szul_ido = $request->input('szul_ido');
        $allaskereso->telefonszam = $request->input('telefonszam');
        $allaskereso->email = $request->input('email');
        $allaskereso->allampolgarsag = $request->input('allampolgarsag');
        $allaskereso->jogositvany = $request->input('jogositvany');
        $allaskereso->szoc_keszseg = $request->input('szoc_keszseg');
        $allaskereso->save();
    }

    public function update(Request $request, $id){
        $allaskereso = Allaskereso::findOrFail($id);
        $allaskereso->nev = $request->input('nev');
        $allaskereso->nem = $request->input('nem');
        $allaskereso->szul_ido = $request->input('szul_ido');
        $allaskereso->telefonszam = $request->input('telefonszam');
        $allaskereso->email = $request->input('email');
        $allaskereso->allampolgarsag = $request->input('allampolgarsag');
        $allaskereso->jogositvany = $request->input('jogositvany');
        $allaskereso->szoc_keszseg = $request->input('szoc_keszseg');
        $allaskereso->save();
    }

    public function destroy($id){
        Allaskereso::findOrFail($id)->delete();
    }


}
