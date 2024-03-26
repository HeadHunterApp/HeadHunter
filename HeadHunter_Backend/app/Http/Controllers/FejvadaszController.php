<?php

namespace App\Http\Controllers;

use App\Models\Fejvadasz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FejvadaszController extends Controller
{
    public function index(){
        return Fejvadasz::all();
    }

    public function show($id){
        $fejvadasz = Fejvadasz::findOrFail($id);
        $user = User::where('user_id', $id)->first(['user_id', 'nev', 'email']);
        $result = [
            'user' => $user,
            'fejvadasz'=> $fejvadasz
        ];
        return $result;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $fejvadasz = Fejvadasz::findOrFail($signed);
        $user = User::where('user_id', $signed)->first(['user_id', 'nev', 'email']);
        $result = [
            'user' => $user,
            'fejvadasz'=> $fejvadasz
        ];
        return $result;
    }

    public function store(Request $request){
        $user=new User();
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        $user->jogosultsag = 'fejvadász';
        $user->save();
        $fejvadasz=new Fejvadasz();
        $fejvadasz->user_id = $user->user_id;
        $validator = Validator::make($request->all(), Fejvadasz::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $fejvadasz->fill($request->all());     
        $fejvadasz->save();
        return response()->json('Sikeres mentés', 200);
    }

    public function update(Request $request, $id){
        $user=User::findOrFail($id);
        $user->fill($request->all());
        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);
        }
        $user->save();
        $validator = Validator::make($request->all(), Fejvadasz::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $fejvadasz=Fejvadasz::findOrFail($id);
        $fejvadasz->fill($request->all());     
        $fejvadasz->save();
        return response()->json('Sikeres mentés', 200);
    }

    public function updatesigned(Request $request){
        $signed = Auth::user()->user_id;
        $user=User::findOrFail($signed);
        $user->fill($request->all());
        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);
        }
        $user->save();
        $validator = Validator::make($request->all(), Fejvadasz::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $fejvadasz = Fejvadasz::findOrFail($signed);
        $fejvadasz->fill($request->all());     
        $fejvadasz->save();
        return response()->json('Sikeres mentés', 200);
    }

    public function destroy($id){
        $fejvadasz=Fejvadasz::findOrFail($id);
        $fejvadasz->delete();
    }
}
