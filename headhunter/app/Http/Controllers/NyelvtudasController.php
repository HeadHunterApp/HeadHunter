<?php

namespace App\Http\Controllers;

use App\Models\Nyelvtudas;
use Illuminate\Http\Request;

class NyelvtudasController extends Controller
{
    public function index(){
        $nyelvtudass= response()->json(Nyelvtudas::all());
        return $nyelvtudass;
    }

    public function show($nyelv, $szint){
        $nyelvtudas = Nyelvtudas::where('nyelv', $nyelv)
            ->where('szint', $szint)
            ->first();

        if ($nyelvtudas) {
            return response()->json($nyelvtudas);
        } else {
            return response()->json(['message' => 'Nincs találat.'], 404);
        }
    }

    public function store(Request $request){
        $nyelvtudas = new Nyelvtudas();
        $nyelvtudas->nyelv = $request->nyelv;
        $nyelvtudas->szint = $request->szint;
        $nyelvtudas->megnevezes = $request->megnevezes;
        $nyelvtudas->save();

        return response()->json($nyelvtudas, 201);
    }

    public function update(Request $request, $nyelv, $szint){
        $nyelvtudas = Nyelvtudas::where('nyelv', $nyelv)
            ->where('szint', $szint)
            ->first();

        if ($nyelvtudas) {
            $nyelvtudas->update($request->all());
            return response()->json($nyelvtudas, 200);
        } else {
            return response()->json(['message' => 'Nincs találat.'], 404);
        }
    }

    public function destroy($nyelv, $szint){
        $nyelvtudas = Nyelvtudas::where('nyelv', $nyelv)
            ->where('szint', $szint)
            ->first();

        if ($nyelvtudas) {
            $nyelvtudas->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['message' => 'Nincs találat.'], 404);
        }
    }
}
