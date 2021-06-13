<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::orderBy('name')->get();
        
        return view('master.prodi.index',compact('prodi'));
    }

    public function store(Request $request)
    {
        try {
            $prodi = new Prodi;
            $prodi->name = $request->name;
            $prodi->save();
            
            return back()->with('success','Berhasil menambahkan prodi '.$request->name);
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menambahkan prodi '.$request->name);
        }
    }

    public function delete($id)
    {
        try {
            $prodi = Prodi::find($id);
            if(!$prodi){
                return back()->with('error','Terjadi kesalahan');
            }
            $prodi->delete();
            return back()->with('success','Berhasil menghapus prodi '.$prodi->name);
        } catch (\Throwable $th) {
            return back()->with('error','Gagal menghapus prodi '.$th->getMessage());
        }
    }
}
