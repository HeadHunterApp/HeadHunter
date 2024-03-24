<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        // $users=response()->json(User::all());
        // return $users;
        return User::all();
    }

    public function show($id){
        //$user=response()->json(User::find($id));
        //return $user;
        return User::findOrFail($id);
    }
/*
    public function store(Request $request){
        $user=new User();
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        if(Route::currentRouteName() === 'admin.headhunters.new') {
            $user->jogosultsag = 'fejvadász';
        }else{
            $user->jogosultsag = 'álláskereső';
        }
        $user->save();
        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
    }
*/
/*
    public function update(Request $request, $id){
        $user=User::findOrFail($id);
        $user->nev=$request->nev;
        $user->email=$request->email;
        $user->jelszo=Hash::make($request->jelszo);
        $user->save();
    }
*/
    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
    }
}
