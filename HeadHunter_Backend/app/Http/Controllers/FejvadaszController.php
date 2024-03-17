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
        $fejvadasz = Fejvadasz::where('user_id', $id)->first();
        $user = User::where('user_id', $id)->first(['nev', 'email']);
        $result = [
            'fejvadasz'=> $fejvadasz,
            'user' => $user,
        ];
        return $result;
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
