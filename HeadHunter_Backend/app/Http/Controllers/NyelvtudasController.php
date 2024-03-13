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

    public function show($nyelvkod){
        /*$nyelvtudas = Nyelvtudas::where('nyelv', $nyelv)
        ->where('szint','=', $szint)
        ->get(); - összetett kulcsok felszámolása*/
        return Nyelvtudas::findOrFail($nyelvkod);

    }

    public function store(Request $request){
        $nyelvtudas = new Nyelvtudas();
        $nyelvtudas->fill($request->all());
        $nyelvtudas->save();
    }

    public function update(Request $request, $nyelvkod){
        //$nyelvtudas = $this->show($nyelv, $szint); - összetett kulcsok felszámolása
        $nyelvtudas = Nyelvtudas::findOrFail($nyelvkod);
        $nyelvtudas->fill($request->all());
        $nyelvtudas->save();
    }

    public function destroy($nyelvkod){
        //$this->show($nyelv, $szint)->delete(); - összetett kulcsok felszámolása
        $nyelvtudas = Nyelvtudas::findOrFail($nyelvkod);
        $nyelvtudas->delete();
    }
}
