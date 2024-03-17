<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\AllaskeresoIsmeret;
use App\Models\User;
use Illuminate\Http\Request;

class AllaskeresoIsmeretController extends Controller
{
    public function index(){
        return AllaskeresoIsmeret::all();
    }

    public function show($allasker,$ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        return $akism;
    }

    public function showallasker($allasker){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)->get();
        return $akism;
    }

    public function store(Request $request){
        $akism = new AllaskeresoIsmeret();
        $akism->fill($request->all());
        $akism->save();
    }

    public function update(Request $request, $allasker, $ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $akism->fill($request->all());
        $akism->save();
    }

    public function destroy($allasker,$ismeret){
        $akism = AllaskeresoIsmeret::where('allaskereso', $allasker)
        ->where('szakmai_ismeret','=', $ismeret)
        ->firstOrFail();
        $akism->delete();
    }
}