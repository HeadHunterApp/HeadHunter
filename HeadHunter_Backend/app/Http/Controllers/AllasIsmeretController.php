<?php

namespace App\Http\Controllers;

use App\Models\AllasIsmeret;
use Illuminate\Http\Request;

class AllasIsmeretController extends Controller
{
    public function index(){
        
        return AllasIsmeret::all();
    }

    public function show($allas,$ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        return $allasism;
    }

    public function showallas($allas){
        $allasism = AllasIsmeret::where('allas', $allas)->get();
        return $allasism;
    }

    public function store(Request $request){
        $allasism = new AllasIsmeret();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function update(Request $request, $allas, $ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $allasism->fill($request->all());
        $allasism->save();
    }

    public function destroy($allas,$ismeret){
        $allasism = AllasIsmeret::where('allas', $allas)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $allasism->delete();
    }
}