<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users=response()->json(User::all());
        return $users;
    }

    public function show($id){
        $user=response()->json(User::find($id));
        return $user;
    }

    public function store(Request $request){
        $user=new User();
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        //jogosultsághoz magában a requestben kell megadni értékként a feltételt!
        $user->jogosultsag=$request->jogosultsag;
        $user->save();
    }

    public function update(Request $request, $id){
        $user=User::find($id);
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        $user->jogosultsag=$request->jogosultsag;
        $user->save();
    }

    public function destroy($id){
        $user=User::find($id);
        $user->delete();
    }
}
