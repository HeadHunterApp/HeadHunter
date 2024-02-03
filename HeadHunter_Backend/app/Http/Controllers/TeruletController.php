<?php

namespace App\Http\Controllers;

use App\Models\Terulet;
use Illuminate\Http\Request;

class TeruletController extends Controller
{
    public function index(){
        
        return Terulet::all();
    }

    public function show($id){
        return Terulet::findOrFail($id);
    }

    public function store(Request $request){
        $terulet = new Terulet();
        $terulet -> megnevezes = $request->megnevezes;
        $terulet->save();

    }

    public function update(Request $request, $id){
        $terulet = Terulet::findOrFail($id);
        $terulet -> megnevezes = $request->megnevezes;
        $terulet->save();

    }

    public function destroy($id){
        $terulet = Terulet::findOrFail($id);
        $terulet->delete();

    }
}
