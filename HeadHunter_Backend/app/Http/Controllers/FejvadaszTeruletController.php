<?php

namespace App\Http\Controllers;

use App\Models\FejvadaszTerulet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response()->json(['message' => 'Fejvadászhoz tartozó terület rögzítve'], 200);
    }
 
    public function show ($fejvadasz,$terulet)
    {
        $fejvadaszterulet = FejvadaszTerulet::where('fejvadasz', $fejvadasz)->where('terulet', $terulet)->firstOrFail();
        return $fejvadaszterulet;
    }

    public function showfejv($fejvadasz)
    {
        $fejvadaszterulet = FejvadaszTerulet::where('fejvadasz', $fejvadasz)->get();
        //lekérdezés az adatok megjelenítéséhez!
        if ($fejvadaszterulet->isEmpty()) {
            return response()->json(['message' => 'Jelenleg egyetlen terület sincs hozzárendelve ehhez a fejvadászhoz'], 404);
        }
        return $fejvadaszterulet;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $fejvadaszterulet = FejvadaszTerulet::where('fejvadasz', $signed)->get();
        //lekérdezés az adatok megjelenítéséhez!
        if ($fejvadaszterulet->isEmpty()) {
            return response()->json(['message' => 'Még egyetlen területet sem rendeltek hozzád'], 404);
        }
        return $fejvadaszterulet;
    }

    public function update(Request $request,$fejvadasz,$terulet)
    {
        $fejvadaszterulet = $this->show($fejvadasz,$terulet);
        $fejvadaszterulet->fill($request->all());
        $fejvadaszterulet->save();
        return response()->json(['message' => 'Fejvadászhoz tartozó területek sikeresen frissítve'], 200);
    }

    public function destroy($fejvadasz,$terulet)
   {
    $this->show($fejvadasz, $terulet)->delete();
   }
}
