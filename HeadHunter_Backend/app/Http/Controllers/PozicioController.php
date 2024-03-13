<?php

namespace App\Http\Controllers;

use App\Models\Pozicio;
use Illuminate\Http\Request;

class PozicioController extends Controller
{
    public function index(){
        
        return Pozicio::all();
    }

    public function show($id){
        return Pozicio::findOrFail($id);
    }

    public function store(Request $request){
        $pozi = new Pozicio();
        $pozi->fill($request->all());
        $pozi->save();
    }

    public function update(Request $request, $id){
        $pozi = Pozicio::findOrFail($id);
        $pozi->fill($request->all());
        $pozi->save();
    }

    public function destroy($id){
        Pozicio::findOrFail($id)->delete();
    }

}
