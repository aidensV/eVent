<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    public function inde()
    {
        
    }

    public function create($id)
    {
        $lab = Lab::find($id);
        return view('master.module.create',compact('id','lab'));
    }
    public function show($id)
    {
        
        $module = Module::where('lab_id',$id)->get();
        
        return view('master.module.index',compact('module'));
    }

    public function store(Request $request)
    {
        try {
             
            $module = new Module;
            $module->name = $request->name;
            $module->uniqid = Str::uuid();
            if($request->hasFile('image_file')){
                $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image_file')->storeAs('public/berkas', $filenameSimpan);
            $module->path_image = $filenameSimpan;
            }else{  
                $module->path_image = '';
            }
            if($request->hasFile('doc_file')){
                $filenameWithExt = $request->file('doc_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('doc_file')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('doc_file')->storeAs('public/berkas/dokumen', $filenameSimpan);
            $module->path_file = $filenameSimpan;
            }else{  
                $module->path_file = '';
            }

            $module->lab_id = $request->lab_id;
            
           
            $module->save();
            return redirect()->route('master.module.show',$request->lab_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function listModule(Request $request)
    {
        $module = Module::where('lab_id',$request->lab_id)->get();
        if($module){
            return response()->json([
                'status' => 'success',
                'data' => $module
            ]);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
