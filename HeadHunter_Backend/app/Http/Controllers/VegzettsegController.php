<?php

namespace App\Http\Controllers;

use App\Models\Vegzettseg;
use Illuminate\Http\Request;

class VegzettsegController extends Controller
{
    public function index(){
        
        return Vegzettseg::all();
    }

    public function show($id){
        return Vegzettseg::findOrFail($id);
    }

    //currently only fix data, maybe modifiable in the future (then routes needed)

/*    public function store(Request $request){
        $vegzettseg = new Vegzettseg();
        $vegzettseg->megnevezes = $request->input('megnevezes');
        $vegzettseg->save();
    }

    public function update(Request $request, $id){
        $vegzettseg = Vegzettseg::findOrFail($id);
        $vegzettseg->megnevezes = $request->input('megnevezes');
        $vegzettseg->save();
    }

    public function destroy($id){
        Vegzettseg::findOrFail($id)->delete();
    }
    */
}
