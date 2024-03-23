<?php

namespace App\Http\Controllers;

use App\Models\Fejvadasz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FejvadaszController extends Controller
{
    public function index(){
        return Fejvadasz::all();
    }

    public function show($id){
        $fejvadasz = Fejvadasz::findOrFail($id);
        $user = User::where('user_id', $id)->first(['nev', 'email']);
        $result = [
            'fejvadasz'=> $fejvadasz,
            'user' => $user,
        ];
        return $result;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $fejvadasz = Fejvadasz::findOrFail($signed);
        $user = User::where('user_id', $signed)->first(['nev', 'email']);
        $result = [
            'fejvadasz'=> $fejvadasz,
            'user' => $user,
        ];
        return $result;
    }

    public function store(Request $request){
        $fejvadasz=new Fejvadasz();
        $validator = Validator::make($request->all(), Fejvadasz::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        return response()->json('Sikeres mentés', 200);
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
