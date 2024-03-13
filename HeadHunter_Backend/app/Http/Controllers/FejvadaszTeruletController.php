<?php

namespace App\Http\Controllers;

use App\Models\FejvadaszTerulet;
use Illuminate\Http\Request;

class FejvadaszTeruletController extends Controller
{
    public function index(){
        $fejvadaszterulet = response()->json(FejvadaszTerulet::all());
        return $fejvadaszterulet;
    }


    public function store(Request $request)
    {
        $fejvadaszterulet = new FejvadaszTerulet();
        $fejvadaszterulet->fejvadasz = $request->fejvadasz;
        $fejvadaszterulet->terulet = $request->terulet;
        $fejvadaszterulet->save();
    }

 
    public function show ($fejvadasz,$terulet)
    {
        $fejvadaszterulet = FejvadaszTerulet::where('fejvadasz', $fejvadasz)->where('terulet', $terulet)->first();
        return $fejvadaszterulet;
    }

    public function update(Request $request,$fejvadasz,$terulet)
    {
        $fejvadaszterulet = $this->show($fejvadasz,$terulet);
        $fejvadaszterulet->fill($request->all());
        $fejvadaszterulet->save();
    }

    public function destroy($fejvadasz,$terulet)
   {
    $this->show($fejvadasz, $terulet)->delete();
   }
}
