<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Module;
use App\Models\Prodi;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $lab = Lab::with('prodi')->whereHas('prodi')->get();
        $prodi = Prodi::all();
        
        return view('master.lab.index',compact('lab','prodi'));
    }
    public function show($id)
    {
        $lab = Lab::with('prodi')->where('prodi_id',$id)->get();
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
            return back()->with('success','Berhasil menambahkan lab '.$request->name);
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menambahkan lab '.$request->name);
        }
    }

    public function showModule($id)
    {
        
        $module = Module::where('lab_id',$id)->get();
        
        return view('master.module.index',compact('module'));
    }

    public function delete($id)
    {
        try {
            $lab = Lab::find($id);
            if(!$lab){
                return back()->with('success','Terjadi kesalahan ');
            }
            $lab->delete();
            return back()->with('success','Berhasil menghapus lab '.$lab->name);
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus lab');
        }
    }

    // API

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
