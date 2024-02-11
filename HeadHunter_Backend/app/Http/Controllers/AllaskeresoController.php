<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Http\Request;

class AllaskeresoController extends Controller
{
    public function index(){
        return Allaskereso::all();
    }

    public function show($id){
        $allaskereso = User::where('user_ID', $id)->first(['nev', 'email']);
        $allaskereso = Allaskereso::where('user_ID', $id)->first();
        return $allaskereso;
    }

    public function store(Request $request){
        $allaskereso=new Allaskereso();
        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function update(Request $request, $id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->fill($request->all());     
        $allaskereso->save();
    }

    public function destroy($id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->delete();
    }
}
