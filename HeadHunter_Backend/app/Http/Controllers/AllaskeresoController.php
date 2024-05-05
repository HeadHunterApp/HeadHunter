<?php

namespace App\Http\Controllers;

use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AllaskeresoController extends Controller
{
    public function index(){
        //return Allaskereso::all();
        $allaskeresok = DB::table('allaskeresos as ak')
        ->join('users as u', 'ak.user_id', '=', 'u.user_id')
        ->select(
            'u.nev',
            'u.email',
            'ak.*'
        )->get();
        return $allaskeresok;
    }

    public function show($id){
        $allaskereso = Allaskereso::findOrFail($id);
        $user = User::where('user_id', $id)
            ->first(['nev', 'email']);

        if (Auth::check() && (Auth::user()->jogosultsag === 'admin' || Auth::user()->jogosultsag === 'fejvadasz')) {
            $result = [
                'nev' => $user->nev,
                'email' => $user->email,
                'telefonszam'=> $allaskereso->telefonszam,
                'fax'=> $allaskereso->fax,
                'allampolgarsag'=> $allaskereso->allampolgarsag,
                'szul_ido'=> $allaskereso->szul_ido,
                'jogositvany'=> $allaskereso->jogositvany,
                'keszseg'=> $allaskereso->keszseg,
                'neme'=> $allaskereso->neme,
                'cim'=> $allaskereso->cim,
            ];
        }

        return $result;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $allaskereso = Allaskereso::findOrFail($signed);
        $user = User::where('user_id', $signed)->first(['nev', 'email']);
        $result = [
            'nev' => $user->nev,
            'email' => $user->email,
            'telefonszam'=> $allaskereso->telefonszam,
            'fax'=> $allaskereso->fax,
            'allampolgarsag'=> $allaskereso->allampolgarsag,
            'szul_ido'=> $allaskereso->szul_ido,
            'jogositvany'=> $allaskereso->jogositvany,
            'keszseg'=> $allaskereso->keszseg,
            'neme'=> $allaskereso->neme,
            'cim'=> $allaskereso->cim,
        ];
        return $result;
    }

    public function showsignedv2(){
        $signed = Auth::user()->user_id;
        $allaskereso = Allaskereso::findOrFail($signed);
        $user = User::where('user_id', $signed)->first(['nev', 'email', 'fenykep']);
        $result = [
            'nev' => $user->nev,
            'email' => $user->email,
            'telefonszam'=> $allaskereso->telefonszam,
            'fax'=> $allaskereso->fax,
            'allampolgarsag'=> $allaskereso->allampolgarsag,
            'szul_ido'=> $allaskereso->szul_ido,
            'jogositvany'=> $allaskereso->jogositvany,
            'keszseg'=> $allaskereso->szoc_keszseg,
            'neme'=> $allaskereso->nem,
            'cim'=> $allaskereso->cim,
            'anyanyelv'=> $allaskereso->anyanyelv
        ];

        Log::error("------------------------ USER FÉNYKÉP ----------------------------");
        Log::error($user);

        if($user->fenykep)
        {
            $path = public_path($user->fenykep);
            $imageData = file_get_contents($path);
            $imageBase64 = base64_encode($imageData);
            $result['fenykep'] = $imageBase64;
        }

        return $result;
    }

    public function showAllByUser($user_id){
        $allaskereso = Allaskereso::findOrFail($user_id);
        $user = User::where('user_id', $user_id)->first(['nev', 'email', 'fenykep']);
        $result = [
            'nev' => $user->nev,
            'email' => $user->email,
            'telefonszam'=> $allaskereso->telefonszam,
            'fax'=> $allaskereso->fax,
            'allampolgarsag'=> $allaskereso->allampolgarsag,
            'szul_ido'=> $allaskereso->szul_ido,
            'jogositvany'=> $allaskereso->jogositvany,
            'keszseg'=> $allaskereso->szoc_keszseg,
            'neme'=> $allaskereso->nem,
            'cim'=> $allaskereso->cim,
            'anyanyelv'=> $allaskereso->anyanyelv
        ];

        Log::error("------------------------ USER FÉNYKÉP ----------------------------");
        Log::error($user);

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
        return response()->json(['message' => 'Új álláskereső létrehozva'], 200);
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
        return response()->json(['message' => 'Álláskereső adatai sikeresen frissítve'], 200);
    }

    public function updatesigned(Request $request){
        $signed = Auth::user()->user_id;
        $user=User::findOrFail($signed);

        //$user->fill($request->all());
        $user->nev = $request->nev;
        $user->email = $request->email;

        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);

        }

        $user->save();

        $allaskereso = Allaskereso::findOrFail($signed);

        $validator = Validator::make($request->all(), Allaskereso::$updateRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //$allaskereso->fill($request->all());   
        $allaskereso->fax = $request->fax;
        $allaskereso->allampolgarsag = $request->allampolgarsag;
        $allaskereso->szul_ido = $request->szul_ido;
        $allaskereso->jogositvany = $request->jogositvany;
        $allaskereso->szoc_keszseg = $request->keszseg;
        $allaskereso->nem = $request->neme;
        $allaskereso->cim = $request->cim;
        $allaskereso->anyanyelv = $request->anyanyelv;

        $allaskereso->save();
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function updatesignedv2(Request $request){
        $signed = Auth::user()->user_id;
        $user=User::findOrFail($signed);

        //$user->fill($request->all());
        $user->nev = $request->nev;
        $user->email = $request->email;

        if ($request->has('jelszo')) {
            $user->jelszo=Hash::make($request->jelszo);

        }

        $user->save();

        $allaskereso = Allaskereso::findOrFail($signed);

        $validator = Validator::make($request->all(), Allaskereso::$updateRules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //$allaskereso->fill($request->all());   
        $allaskereso->fax = $request->fax;
        $allaskereso->telefonszam = $request->telefonszam;
        $allaskereso->allampolgarsag = $request->allampolgarsag;
        $allaskereso->szul_ido = $request->szul_ido;
        $allaskereso->jogositvany = $request->jogositvany;
        $allaskereso->szoc_keszseg = $request->keszseg;
        $allaskereso->nem = $request->neme;
        $allaskereso->cim = $request->cim;
        $allaskereso->anyanyelv = $request->anyanyelv;

        $allaskereso->save();
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function destroy($id){
        $allaskereso=Allaskereso::findOrFail($id);
        $allaskereso->delete();
    }
}
