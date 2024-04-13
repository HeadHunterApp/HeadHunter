<?php

namespace App\Http\Controllers;

use App\Models\SzakmaiIsmeret;
use Illuminate\Http\Request;

class SzakmaiIsmeretController extends Controller
{
    public function index(){
        
        return SzakmaiIsmeret::all();
    }

    public function show($id){
        return SzakmaiIsmeret::findOrFail($id);
    }

    public function store(Request $request){
        $szakmaiismeret = new SzakmaiIsmeret();
        // $szakmaiismeret->megnevezes = $request->input('megnevezes');
        // $szakmaiismeret->szint = $request->input('szint');
        $szakmaiismeret->fill($request->all());
        $szakmaiismeret->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $id){
        $szakmaiismeret = SzakmaiIsmeret::findOrFail($id);
        // $szakmaiismeret->megnevezes = $request->input('megnevezes');
        // $szakmaiismeret->szint = $request->input('szint');
        $szakmaiismeret->fill($request->all());
        $szakmaiismeret->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function destroy($id){
        SzakmaiIsmeret::findOrFail($id)->delete();
    }
}
