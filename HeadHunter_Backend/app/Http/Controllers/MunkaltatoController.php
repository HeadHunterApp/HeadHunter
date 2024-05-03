<?php

namespace App\Http\Controllers;

use App\Models\Munkaltato;
use Illuminate\Http\Request;

class MunkaltatoController extends Controller
{
    public function index(){
        
        return Munkaltato::all();
    }

    public function show($id){
        return Munkaltato::findOrFail($id);
    }

    /* public function store(Request $request){
        $munkaltato = new Munkaltato();
         $munkaltato->cegnev = $request->input('cegnev');
         $munkaltato->szekhely = $request->input('szekhely');
         $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
         $munkaltato->telefonszam = $request->input('telefonszam');
         $munkaltato->email = $request->input('email');
        $munkaltato->fill($request->all());
        $munkaltato->save();
        return response()->json(['message' => 'Új munkáltató rögzítve'], 200); 
        //régit kikommenteltem de itt van ha nem jó cserélem vissza
        public function store(Request $request)
   } */
   public function store(Request $request)
    {
    // bej9övő adata validálása
    $validatedData = $request->validate([
        'cegnev' => 'required|string|max:255',
        'szekhely' => 'required|string|max:255',
        'kapcsolattarto' => 'required|string|max:255',
        'telefonszam' => 'required|string|max:20',
        'email' => 'required|email|unique:munkaltatos|max:255',
    ]);

    // ujmunkaltato validált adatokkal
    $munkaltato = Munkaltato::create($validatedData);

    // JSON RESPONSE siker esetén
    return response()->json(['message' => 'Új munkáltató rögzítve', 'munkaltato' => $munkaltato], 201);
}
    /* {
        // Validáció
        $validatedData = $request->validate([
            'cegnev' => 'required|string|max:255',
            'szekhely' => 'required|string|max:255',
            'kapcsolattarto' => 'required|string|max:255',
            'telefonszam' => 'required|string|max:20',
            'email' => 'required|email|unique:munkaltato|max:255',
        ]);

        // Új munkáltató létrehozása az adatok alapján
        $munkaltato = Munkaltato::create($validatedData);

        // Válasz küldése a kliensnek
        return response()->json(['message' => 'Munkáltató sikeresen hozzáadva', 'munkaltatos' => $munkaltato], 201);
    } */

    public function update(Request $request, $id){
        $munkaltato = Munkaltato::findOrFail($id);
        // $munkaltato->cegnev = $request->input('cegnev');
        // $munkaltato->szekhely = $request->input('szekhely');
        // $munkaltato->kapcsolattarto = $request->input('kapcsolattarto');
        // $munkaltato->telefonszam = $request->input('telefonszam');
        // $munkaltato->email = $request->input('email');
        $munkaltato->fill($request->all());
        $munkaltato->save();
        return response()->json(['message' => 'Munkáltató adatai sikeresen frissítve'], 200); 
    }

    public function destroy($munkaltato_id){
        try {
            $munkaltato = Munkaltato::findOrFail($munkaltato_id);
            $munkaltato->delete();
            return response()->json(['message' => 'Munkáltató sikeresen törölve'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hiba történt a munkáltató törlésekor: ' . $e->getMessage()], 500);
        }
    }
    
    
}
