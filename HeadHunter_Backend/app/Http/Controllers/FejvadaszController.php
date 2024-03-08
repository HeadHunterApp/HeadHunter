<?php

namespace App\Http\Controllers;

use App\Models\Fejvadasz;
use App\Models\User;
use Illuminate\Http\Request;

class FejvadaszController extends Controller
{
    public function index(){
        return Fejvadasz::all();
    }

    public function show($id){
        $fejvadasz = User::where('user_id', $id)->first(['nev', 'email']);
        $fejvadasz = Fejvadasz::where('user_id', $id)->first();
        return $fejvadasz;
    }

    public function store(Request $request){
        $fejvadasz=new Fejvadasz();
        $fejvadasz->fill($request->all());     
        $fejvadasz->save();
    }

    public function update(Request $request, $id){
        $fejvadasz=Fejvadasz::findOrFail($id);
        $fejvadasz->fill($request->all());     
        $fejvadasz->save();
    }

    public function destroy($id){
        $fejvadasz=Fejvadasz::findOrFail($id);
        $fejvadasz->delete();
    }
}
