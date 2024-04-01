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
        $fileName = $request->file->getClientOruóiginalName();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success', 'You have succesfully uploaded the file')
            ->with('file', $fileName);
    }
}
