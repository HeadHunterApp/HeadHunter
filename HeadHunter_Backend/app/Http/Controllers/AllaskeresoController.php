<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AllaskeresoController extends Controller
{
    public function index(){
        return Allaskereso::all();
    }

    public function show($id){
        $allaskereso = Allaskereso::findOrFail($id);
        $user = User::where('user_id', $id)->first(['nev', 'email']);
        $result = [
            'allaskereso'=> $allaskereso,
            'user' => $user,
        ];
        return $result;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $allaskereso = Allaskereso::findOrFail($signed);
        $user = User::where('user_id', $signed)->first(['nev', 'email']);
        $result = [
            'allaskereso'=> $allaskereso,
            'user' => $user,
        ];
        return $result;
    }

    public function store(Request $request){
        $user=new User();
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        $user->jogosultsag = 'álláskereső';
        $user->save();
        $allaskereso=new Allaskereso();
        $allaskereso->user_id = $user->user_id;
        $validator = Validator::make($request->all(), Allaskereso::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $allaskereso->fill($request->all()); 
        $allaskereso->save();
        return response()->json('Sikeres mentés', 200);
    }

    public function update(Request $request, $id){
        $user=User::findOrFail($id);
        $user->fill($request->all());
        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);
        }
        $user->save();
        $allaskereso=Allaskereso::findOrFail($id);
        $validator = Validator::make($request->all(), Allaskereso::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $allaskereso->fill($request->all());     
        $allaskereso->save();
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
        $allaskereso = Allaskereso::findOrFail($signed);
        $validator = Validator::make($request->all(), Allaskereso::$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $allaskereso->fill($request->all());     
        $allaskereso->save();
        return response()->json('Sikeres mentés', 200);
    }

    public function destroy($id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->delete();
    }
}
