<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllaskeresoController extends Controller
{
    public function index(){
        return Allaskereso::all();
    }

    public function show($id){
        $allaskereso = Allaskereso::where('user_id', $id)->findOrFail();
        $user = User::where('user_id', $id)->first(['nev', 'email']);
        $result = [
            'allaskereso'=> $allaskereso,
            'user' => $user,
        ];
        return $result;
    }

    public function store(Request $request){
        $allaskereso=new Allaskereso();


        $validator = Validator::make($request->all(), Allaskereso::$rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

    
        return response()->json('Sikeres mentés', 200);

        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function update(Request $request, $id){
        $allaskereso=Allaskereso::findOrFail($id);
        $validator = Validator::make($request->all(), Allaskereso::$rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

    
        return response()->json('Sikeres mentés', 200);
        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function destroy($id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->delete();
    }
}
