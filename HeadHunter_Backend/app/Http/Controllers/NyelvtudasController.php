<?php

namespace App\Http\Controllers;

use App\Models\Nyelvtudas;
use Illuminate\Http\Request;

class NyelvtudasController extends Controller
{
    public function index(){
        // $nyelvtudass= response()->json(Nyelvtudas::all());
        // return $nyelvtudass;
        return Nyelvtudas::all();
    }

    public function show($nyelv, $szint){
        $nyelvtudas = Nyelvtudas::where('nyelv', $nyelv)
        ->where('szint','=', $szint)
        ->get();
        return $nyelvtudas;

    }

    public function store(Request $request){
        $nyelvtudas = new Nyelvtudas();
        // $nyelvtudas->nyelv = $request->nyelv;
        // $nyelvtudas->szint = $request->szint;
        // $nyelvtudas->megnevezes = $request->megnevezes;
        $nyelvtudas->fill($request->all());
        $nyelvtudas->save();
    }

    public function update(Request $request, $nyelv, $szint){
        $nyelvtudas = $this->show($nyelv, $szint);
        // $nyelvtudas->nyelv = $request->nyelv;
        // $nyelvtudas->szint = $request->szint;
        // $nyelvtudas->megnevezes = $request->megnevezes;
        $nyelvtudas->fill($request->all());
        $nyelvtudas->save();
    }

    public function destroy($nyelv, $szint){
        $this->show($nyelv, $szint)->delete();
    }
}
