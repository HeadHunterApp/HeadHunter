<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //public function index()  {
    //    return view("fileUpload");
    //}

    public function store(Request $request){ 
        $request->validate([
            'file'=> 'required|mimes:pdf,xls,csv,png,jpg|max:2048' 
        ]);
        $fileName = $request->file->getClientOriginalName();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success', 'Fájl sikeresen feltöltve')
            ->with('file', $fileName);
    }
}
