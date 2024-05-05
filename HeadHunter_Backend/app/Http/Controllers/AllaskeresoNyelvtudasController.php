<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoNyelvtudas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;



        /*szintek és megnevezések:
            A1 - kezdő
            A2 - alapszint
            B1 - küszöbszint - ez az első három maradjon az eredeti megnevezésével
            B2 - középszint - ez a társalgási szint
            C1 - haladó szint - ez a tárgyalóképes szint
            C2 - mesterfok - ez az anyanyelvi szint
        */


class AllaskeresoNyelvtudasController extends Controller
{
    public function index(){
        
        return AllaskeresoNyelvtudas::all();
    }

    public function show($allasker,$nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        return $aknyelv;
    }

    public function showallasker($allasker){
        $aknyelv = DB::table('allaskereso_nyelvtudas as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $allasker)
        ->select(
            'nt.nyelv',
            'nt.szint',
            DB::raw('case 
                when nt.szint = "A1" THEN "kezdő"
                when nt.szint = "A2" THEN "alapszint"
                when nt.szint = "B1" THEN "küszöbszint"
                when nt.szint = "B2" THEN "társalgási szint"
                when nt.szint = "C1" THEN "tárgyalóképes szint"
                when nt.szint = "C2" THEN "anyanyelvi szint"
                else "egyéb"
                end
                as megnevezes'),//egyéb csak egyedi hibánál fordulhat elő
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();
        if ($aknyelv->isEmpty()) {
            return response()->json(['message' => 'Nyelvtudás nem került megadásra'], 404);
        }
        return $aknyelv;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        //$signed = 3;
        $aknyelv = DB::table('allaskereso_nyelvtudass as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $signed)
        ->select(
            'nt.nyelv',
            'nt.szint',
            DB::raw('case 
                when nt.szint = "A1" THEN "kezdő"
                when nt.szint = "A2" THEN "alapszint"
                when nt.szint = "B1" THEN "küszöbszint"
                when nt.szint = "B2" THEN "társalgási szint"
                when nt.szint = "C1" THEN "tárgyalóképes szint"
                when nt.szint = "C2" THEN "anyanyelvi szint"
                else "egyéb"
                end
                as megnevezes'),//egyéb csak egyedi hibánál fordulhat elő
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();
        //if ($aknyelv->isEmpty()) {
        //    return response()->json(['message' => 'Még nem adtál meg a nyelvtudásodra vonatkozó adatot'], 404);
        //}
        return $aknyelv;

/*         $result = [
            'nyelvtudas'=> $aknyelv,
            'allaskeresonyelkod' => $aknyelv->allaskeresoNyelvtudas->nyelvkod->megnevezes
        ];
        return $result; */
    }

     public function showsignedv2(){
        $signed = Auth::user()->user_id;

        $aknyelv = DB::table('allaskereso_nyelvtudass as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $signed)
        ->select(
            'nt.nyelv',
            'nt.szint',
            //'nt.megnevezes',
            'akny.nyelvtudas',
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();

        //TODO: majd rakjjuk vissza
        //if ($aknyelv->isEmpty()) {
        //    return response()->json(['message' => 'Még nem adtál meg a nyelvtudásodra vonatkozó adatot'], 404);
        //}

        return $aknyelv;
    }

    public function showAllByUser($user_id){
        $aknyelv = DB::table('allaskereso_nyelvtudass as akny')
        ->join('nyelvtudass as nt', 'akny.nyelvtudas','=','nt.nyelvkod')
        ->where('allaskereso', $user_id)
        ->select(
            'nt.nyelv',
            'nt.szint',
            //'nt.megnevezes',
            'akny.nyelvtudas',
            'akny.nyelvvizsga',
            'akny.iras',
            'akny.olvasas',
            'akny.beszed'
            )
        ->get();

        //TODO: majd rakjjuk vissza
        //if ($aknyelv->isEmpty()) {
        //    return response()->json(['message' => 'Még nem adtál meg a nyelvtudásodra vonatkozó adatot'], 404);
        //}

        return $aknyelv;
    }

    public function store(Request $request){
        $signed = Auth::user()->user_id;
        $aknyelv = new AllaskeresoNyelvtudas();
        $aknyelv->fill($request->all());
        $aknyelv->allaskereso = $signed;
        $aknyelv->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function storesigned(Request $request){
        $signed = Auth::user()->user_id;
        $aknyelv = new AllaskeresoNyelvtudas();
        $aknyelv->allaskereso=$signed;
        $aknyelv->fill($request->all());
        $aknyelv->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allasker, $nyelvtudas){
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->fill($request->all());
        $aknyelv->save();
        return response()->json(['message' => 'Nyelvtudásra vonatkozó adatok frissítve'], 200);
    }

    public function updatesigned(Request $request){
        $signed = Auth::user()->user_id;
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $signed)
        ->where('nyelvtudas','=', $request->nyelvtudas)
        ->first();
        
        if(!$aknyelv)
        {
            return $this->store($request);
        }
        else
        {
            $aknyelv->fill($request->all());
            $aknyelv->save();
        }
        
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);


    }

    public function updatesignedv2(Request $request){
        $signed = Auth::user()->user_id;
        $nyelvismeret = AllaskeresoNyelvtudas::where('allaskereso', $signed)
        ->where('nyelvtudas','=', $request->origNyelvTudas)
        ->first();
        
        Log::error($request);

        if(!$nyelvismeret)
        {
            //Log::error("Újat adok hozzá!");

            AllaskeresoNyelvtudas::Create([
                'allaskereso' => $signed,
                'nyelvtudas' => $request->selectedNyelv['value'],
                'nyelvvizsga' => $request->nyelvvizsga,
                'iras' => $request->iras,
                'olvasas' => $request->olvasas,
                'beszed' => $request->beszed
            ]);
        }
        else
        {
            //Log::error("Módosítok!");
            //Log::error($request->selectedNyelv['value']);

            DB::table('allaskereso_nyelvtudass')
            ->where('allaskereso','=', $signed)
            ->where('nyelvtudas','=', $request->origNyelvTudas)
            ->update([
                'nyelvtudas' => $request->selectedNyelv['value'],
                'nyelvvizsga' => $request->nyelvvizsga,
                'iras' => $request->iras,
                'olvasas' => $request->olvasas,
                'beszed' => $request->beszed
            ]);

            //Log::error($nyelvismeret);
        }
        
        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function destroy($allasker,$nyelvtudas){// admin törléséhez
        $aknyelv = AllaskeresoNyelvtudas::where('allaskereso', $allasker)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->firstOrFail();
        $aknyelv->delete();
    }

    public function destroySigned(Request $request){//álláskereső törléséhez
        $signed = Auth::user()->user_id;
        $nyelvtudas = $request->query('nyelvtudas');
        
        DB::table('allaskereso_nyelvtudass')
        ->where('allaskereso', '=', $signed)
        ->where('nyelvtudas','=', $nyelvtudas)
        ->delete();
    
    }
}
