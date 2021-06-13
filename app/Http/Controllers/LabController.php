<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Prodi;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        return view('master.lab.index');
    }
    public function show($id)
    {
        $lab = Lab::where('prodi_id',$id)->get();
        $prodi = Prodi::all();
        return view('master.lab.index',compact('lab','prodi'));
    }

    public function store(Request $request)
    {
        try {
            $lab = new Lab;
            $lab->prodi_id  = $request->prodi;
            $lab->name = $request->name;
            $lab->save();
            return back()->with('success','Berhasil menambahkan prodi '.$request->name);
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menambahkan prodi '.$request->name);
        }
    }

    public function listLab(Request $request)
    {
        
        $lab = Lab::find($request->user()->prodi);
        if($lab){
            return response()->json([
                'status' => 'success',
                'data' => $lab
            ],200);    
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Data tidak ditemukan'
        ],400);
    }
}
