<?php

namespace App\Http\Controllers;

use App\Models\AllaskeresoTanulmany;
use App\Models\Vegzettseg;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AllaskeresoTanulmanyController extends Controller
{
    public function index(){
        return AllaskeresoTanulmany::all();
    }

    public function show($allasker, $intezmeny, $szak){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        return $aktan;
    }

    public function showallasker($allasker){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
            ->select(
                'intezmeny',
                'szak',
                'vegzettseg',
                'kezdes',
                'vegzes',
                'erintett_targytev'
            )
            ->get();
        if ($aktan->isEmpty()) {
            return response()->json(['message' => 'Tanulmányokra vonatkozó adat nem került megadásra'], 404);
        }
        return $aktan;
    }

    public function showsigned(){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
            ->where('allaskereso', $signed)
            ->first();
/*             ->select(
                'intezmeny',
                'szak',
                'vegzettseg',
                'kezdes',
                'vegzes',
                'erintett_targytev'
            )
            ->get(); */

        if (!$aktan) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 200);
        }

        $vegeDatum = $aktan->vegzes ?? date('Y-m-d');
        $result = [
            'idotartam' => $vegeDatum - $aktan->kezdes,
            'kezdes' => $aktan->kezdes,
            'vegzes'=> $aktan->vegzes,
            'intezmeny' => $aktan->intezmeny,
            'erintett_targytev' => $aktan->erintett_targytev,
            'szak'=>$aktan->szak,
            'szoc_keszseg'=> $aktan->allaskeresoEntity->szoc_keszseg,
        ];

        return $result;
    }

    public function showsignedv2(){
        $signed = Auth::user()->user_id;
        $allaskeresoTanulmanyok = DB::table('allaskereso_tanulmanys')
            ->where('allaskereso', $signed)
            ->get();

        if (!$allaskeresoTanulmanyok) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
        }

        $tanulmany_datas = array();
        foreach ($allaskeresoTanulmanyok as $tanulmany) {
            //$vegeDatum = $tanulmany->vegzes ? date('Y-m-d', $tanulmany->vegzes) : date('Y-m-d');
            //Log::error("-------------------- Dátum számolás: ");
            //Log::error($tanulmany->vegzes);
            //Log::error("Mai dátum:");
            //Log::error(date('Y-m-d'));
            //Log::error("kezdés dátum:");
            //Log::error($tanulmany->kezdes);
            //Log::error("kivonás értéke:");
            //Log::error(($vegeDatum - $tanulmany->kezdes));
            //$datumKulonbseg = $vegeDatum->diffInMonths(date('Y-m-d', $tanulmany->kezdes));



            $vegeDatum = $tanulmany->vegzes ? new DateTime($tanulmany->vegzes) : new DateTime();
            $kezdesDatum = new DateTime($tanulmany->kezdes);
            $datumKulonbseg = $vegeDatum->diff($kezdesDatum);
            $datumKulonbsegHonapokban = $datumKulonbseg->y * 12 + $datumKulonbseg->m;
            $vegzettseg = Vegzettseg::where('vegzettseg_id', $tanulmany->vegzettseg)->first();

            $tanulmany_datas[] = [
                'idotartam' => $datumKulonbsegHonapokban,
                'kezdes' => $tanulmany->kezdes,
                'vegzes'=> $tanulmany->vegzes,
                'intezmeny' => $tanulmany->intezmeny,
                'erintett_targytev' => $tanulmany->erintett_targytev,
                'szak'=>$tanulmany->szak,
                'vegzettseg'=>[
                    'id' => $vegzettseg->vegzettseg_id,
                    'megnevezes' => $vegzettseg->megnevezes
                ]
            ] ;
        }

        return $tanulmany_datas;
    }

    public function showAllByUser($user_id){
        $allaskeresoTanulmanyok = DB::table('allaskereso_tanulmanys')
            ->where('allaskereso', $user_id)
            ->get();

        if (!$allaskeresoTanulmanyok) {
            //TODO: 200 nem lesz jó hosszútávon.
            //return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
            return response()->json(['message' => 'Még nem adtad meg, hol végezted a tanulmányaidat'], 404);
        }

        $tanulmany_datas = array();
        foreach ($allaskeresoTanulmanyok as $tanulmany) {
            $vegeDatum = $tanulmany->vegzes ? new DateTime($tanulmany->vegzes) : new DateTime();
            $kezdesDatum = new DateTime($tanulmany->kezdes);
            $datumKulonbseg = $vegeDatum->diff($kezdesDatum);
            $datumKulonbsegHonapokban = $datumKulonbseg->y * 12 + $datumKulonbseg->m;
            $vegzettseg = Vegzettseg::where('vegzettseg_id', $tanulmany->vegzettseg)->first();

            $tanulmany_datas[] = [
                'idotartam' => $datumKulonbsegHonapokban,
                'kezdes' => $tanulmany->kezdes,
                'vegzes'=> $tanulmany->vegzes,
                'intezmeny' => $tanulmany->intezmeny,
                'erintett_targytev' => $tanulmany->erintett_targytev,
                'szak'=>$tanulmany->szak,
                'vegzettseg'=>[
                    'id' => $vegzettseg->vegzettseg_id,
                    'megnevezes' => $vegzettseg->megnevezes
                ]
            ] ;
        }

        return $tanulmany_datas;
    }

    public function store(Request $request){
        $aktan = new AllaskeresoTanulmany();
        $aktan->fill($request->all());
        $aktan->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function storesigned(Request $request){
        $signed = Auth::user()->user_id;
        $aktan = new AllaskeresoTanulmany();
        $aktan->allaskereso=$signed;
        $aktan->fill($request->all());
        $aktan->save();
        return response()->json(['message' => 'Sikeres mentés'], 200);
    }

    public function update(Request $request, $allasker, $intezmeny, $szak){
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        $aktan->fill($request->all());
        $aktan->save();
        return response()->json(['message' => 'Tanulmányokra vonatkozó adatok frissítve'], 200);
    }

    public function updatesigned(Request $request, $intezmeny, $szak){
        $signed = Auth::user()->user_id;
        $aktan = DB::table('allaskereso_tanulmanys')
        ->where('allaskereso','=', $signed)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();

        //$aktan->fill($request->all());
        $aktan->intezmeny = $request->intezmeny;
        $aktan->szak = $request->szakkepesites;
        //$aktan->vegzettseg = $request->vegzettsegId;   //TODO: --> nem látom FE-n
        $aktan->kezdes = $request->oktkezdes;
        $aktan->vegzes = $request->oktvegzes;
        $aktan->erintett_targytev = $request->fotargy;

        $aktan->save();

        return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
    }

    public function updatesignedv2(Request $request){
        $signed = Auth::user()->user_id;
        $tanulmany = DB::table('allaskereso_tanulmanys')
        ->where('allaskereso','=', $signed)
        ->where('intezmeny','=', $request->origIntezmeny)
        ->where('szak','=', $request->origSzakkepesites)
        ->first();

        if($tanulmany)
        {
            DB::table('allaskereso_tanulmanys')
            ->where('allaskereso','=', $signed)
            ->where('intezmeny','=', $request->origIntezmeny)
            ->where('szak','=', $request->origSzakkepesites)
            ->update([
                'intezmeny' => $request->intezmeny,
                'szak' => $request->szakkepesites,
                'vegzettseg' => $request->selectedVegzettseg['value'],
                'kezdes' => $request->oktkezdes,
                'vegzes' => $request->oktvegzes,
                'erintett_targytev' => $request->fotargy,
            ]);

            return response()->json(['message' => 'Adatait sikeresen frissítve'], 200);
        }
        else
        {
            Log::info("--------------------Array cucc:--------------");
            Log::info($request->selectedVegzettseg);
            Log::info($request->selectedVegzettseg['value']);

            DB::table('allaskereso_tanulmanys')->insert([
                'allaskereso' => $signed,
                'intezmeny' => $request->intezmeny,
                'szak' => $request->szakkepesites,
                'vegzettseg' => $request->selectedVegzettseg['value'],
                'kezdes' => $request->oktkezdes,
                'vegzes' => $request->oktvegzes,
                'erintett_targytev' => $request->fotargy
            ]);
        }
    }

    public function destroy($allasker, $intezmeny, $szak){ // ez azért marad, hogy az admin is tudjon törölni
        $aktan = AllaskeresoTanulmany::where('allaskereso', $allasker)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->firstOrFail();
        $aktan->delete();
    }

    public function destroySigned(Request $request){ //ez az álláskereső tudja magánál törölni
        $signed = Auth::user()->user_id;
        $intezmeny = $request->query('intezmeny');
        $szak = $request->query('szak');
        Log::error($request);
        
        DB::table('allaskereso_tanulmanys')
        ->where('allaskereso', $signed)
        ->where('intezmeny','=', $intezmeny)
        ->where('szak','=', $szak)
        ->delete();
    
    }
}
