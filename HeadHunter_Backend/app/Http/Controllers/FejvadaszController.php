<?php

namespace App\Http\Controllers;

use App\Models\Fejvadasz;
use App\Models\FejvadaszTerulet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        $user = $fejvadasz->user;
        //$user = User::where('user_id', $signed)->first(['user_id', 'nev', 'email']);
        $teruletek = $fejvadasz->teruletek;

        $terulet_datas = array();
        foreach ($teruletek as $terulet) {
            $terulet_datas[] = [
                'terulet_id' => $terulet->terulet_id,
                'megnevezes' => $terulet->megnevezes
            ] ;
        }

        $result = [
            'nev' => $user->nev,
            'email' => $user->email,
            'telefonszam'=> $fejvadasz->telefonszam,
            'teruletek' => $terulet_datas
        ];

        if($user->fenykep)
        {
            $path = public_path($user->fenykep);
            $imageData = file_get_contents($path);
            $imageBase64 = base64_encode($imageData);
            $result['fenykep'] = $imageBase64;
        }

        return $result;
    }

    public function showsignedv2(){
        $signed = Auth::user()->user_id;
        $fejvadasz = Fejvadasz::findOrFail($signed);
        $user = $fejvadasz->user;
        $teruletek = $fejvadasz->teruletek;

        $terulet_datas = array();
        foreach ($teruletek as $terulet) {
            $terulet_datas[] = [
                'terulet_id' => $terulet->terulet_id,
                'megnevezes' => $terulet->megnevezes
            ] ;
        }

        $result = [
            'nev' => $user->nev,
            'email' => $user->email,
            'telefonszam'=> $fejvadasz->telefonszam,
            'teruletek' => $terulet_datas
        ];

        if($user->fenykep)
        {
            $path = public_path($user->fenykep);
            $imageData = file_get_contents($path);
            $imageBase64 = base64_encode($imageData);
            $result['fenykep'] = $imageBase64;
        }

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
        return response()->json(['message' => 'Új fejvadász létrehozva'], 200);
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
        return response()->json(['message' => 'Fejvadász adatai sikeresen frissítve'], 200);
    }

    public function updatesigned(Request $request){
        $signed = Auth::user()->user_id;
        $user=User::findOrFail($signed);

        $user->nev = $request->nev;
        $user->email = $request->email;

        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);
        }

        $user->save();

        $validator = Validator::make($request->all(), Fejvadasz::$updaterules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fejvadasz = Fejvadasz::findOrFail($signed);
        $fejvadasz->telefonszam = $request->telefonszam;
        
        $fejvadaszTerulets = FejvadaszTerulet::where('fejvadasz', $signed)
            ->get();
        $fejvadaszTeruletIds = $fejvadaszTerulets->pluck('terulet')->toArray();

        $compareTeruletIds = array();
        foreach ($request->selectedTerulet as $terulet) {
            $compareTeruletIds[] = $terulet['value'];
        }

        $deleteTeruletIds = array_diff($fejvadaszTeruletIds, $compareTeruletIds);
        $addTeruletIds = array_diff($compareTeruletIds, $fejvadaszTeruletIds);

        //DB::enableQueryLog();
        foreach($fejvadaszTerulets as $fejvadaszTerulet)
        {
            $teruletId = $fejvadaszTerulet->terulet;
            if(in_array($teruletId, $deleteTeruletIds))
            {
                //$primaryKeyValues = [$fejvadaszTerulet->fejvadasz, $fejvadaszTerulet->terulet];
                //FejvadaszTerulet::destroy($primaryKeyValues);
                FejvadaszTerulet::where('fejvadasz', $signed)
                    ->where('terulet', $teruletId)
                    ->delete();
            }
        }
        //Log::info(DB::getQueryLog());

        foreach($request->selectedTerulet as $terulet)
        {
            $teruletId = $terulet['value'];
            if(in_array($teruletId, $addTeruletIds))
            {
                FejvadaszTerulet::create([
                    'fejvadasz' => $signed,
                    'terulet' => $teruletId
                ]);
            }
        }
        
        $fejvadasz->save();
        return response()->json(['message' => 'Adataid sikeresen frissítve'], 200);
    }
    
    public function updatesignedv2(Request $request){
        $signed = Auth::user()->user_id;
        $user=User::findOrFail($signed);

        $user->nev = $request->nev;
        $user->email = $request->email;

        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);
        }

        $user->save();

        $validator = Validator::make($request->all(), Fejvadasz::$updaterules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $fejvadasz = Fejvadasz::findOrFail($signed);
        $fejvadasz->telefonszam = $request->telefonszam;
        
        $fejvadaszTerulets = FejvadaszTerulet::where('fejvadasz', $signed)
            ->get();
        $fejvadaszTeruletIds = $fejvadaszTerulets->pluck('terulet')->toArray();

        $compareTeruletIds = array();
        foreach ($request->selectedTerulet as $terulet) {
            $compareTeruletIds[] = $terulet['value'];
        }

        $deleteTeruletIds = array_diff($fejvadaszTeruletIds, $compareTeruletIds);
        $addTeruletIds = array_diff($compareTeruletIds, $fejvadaszTeruletIds);

        //DB::enableQueryLog();
        foreach($fejvadaszTerulets as $fejvadaszTerulet)
        {
            $teruletId = $fejvadaszTerulet->terulet;
            if(in_array($teruletId, $deleteTeruletIds))
            {
                //$primaryKeyValues = [$fejvadaszTerulet->fejvadasz, $fejvadaszTerulet->terulet];
                //FejvadaszTerulet::destroy($primaryKeyValues);
                FejvadaszTerulet::where('fejvadasz', $signed)
                    ->where('terulet', $teruletId)
                    ->delete();
            }
        }
        //Log::info(DB::getQueryLog());

        foreach($request->selectedTerulet as $terulet)
        {
            $teruletId = $terulet['value'];
            if(in_array($teruletId, $addTeruletIds))
            {
                FejvadaszTerulet::create([
                    'fejvadasz' => $signed,
                    'terulet' => $teruletId
                ]);
            }
        }
        
        $fejvadasz->save();
        return response()->json(['message' => 'Adataid sikeresen frissítve'], 200);
    }

    public function destroy($id){
        $fejvadasz=Fejvadasz::findOrFail($id);
        $fejvadasz->delete();
    }
}
