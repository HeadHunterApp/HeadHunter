<?php

namespace App\Http\Controllers;

use App\Models\Fejvadasz;
use Illuminate\Http\Request;

class FejvadaszController extends Controller
{
    public function index(){
        
        return Fejvadasz::all();
    }

    public function show($id){
        return Fejvadasz::findOrFail($id);
    }

    public function store(Request $request){
        $fejvadasz = new Fejvadasz();
        $fejvadasz->nev = $request->input('nev');
        $fejvadasz->tel = $request->input('tel');
        $fejvadasz->email = $request->input('email');
        $fejvadasz->fenykep = $request->input('fenykep');
        $fejvadasz->save();
    }

    public function update(Request $request, $id){
        $fejvadasz = Fejvadasz::findOrFail($id);
        $fejvadasz->nev = $request->input('nev');
        $fejvadasz->tel = $request->input('tel');
        $fejvadasz->email = $request->input('email');
        $fejvadasz->fenykep = $request->input('fenykep');
        $fejvadasz->save();
    }

    public function destroy($id){
        Fejvadasz::findOrFail($id)->delete();
    }
}
