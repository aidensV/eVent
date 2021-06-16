<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Lab;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ModuleController extends Controller
{
    public function inde()
    {
    }

    public function create($id)
    {
        $lab = Lab::find($id);
        return view('master.module.create', compact('id', 'lab'));
    }
    public function show($id)
    {

        $module = Module::where('lab_id', $id)->get();

        return view('master.module.index', compact('module'));
    }

    public function detail($id)
    {

        $module = Module::with('lab')->find($id);
        $history = History::where('modul_id', $id)->get();
        if (!$module) {
            return back();
        }

        return view('master.module.detail', compact('module', 'history'));
    }

    public function store(Request $request)
    {
        try {
            
            $labName = Lab::where('id',$request->lab_id)->first();
            $module = new Module;
            $module->name = $request->name;
            $module->uniqid = '';
            if ($request->hasFile('image_file')) {
                $filenameWithExt = $request->file('image_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image_file')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('image_file')->storeAs('public/berkas', $filenameSimpan);
                $module->path_image = $filenameSimpan;
            } else {
                $module->path_image = '';
            }
            if ($request->hasFile('doc_file')) {
                $filenameWithExt = $request->file('doc_file')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('doc_file')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('doc_file')->storeAs('public/berkas/dokumen', $filenameSimpan);
                $module->path_file = $filenameSimpan;
            } else {
                $module->path_file = '';
            }

            $module->lab_id = $request->lab_id;
            $module->save();
            
            $qrName = 'Event-'.substr($labName->name,0,2).'-'.$module->id;
            $image = QrCode::format('png')
                ->size(200)->errorCorrection('H')
                ->generate($qrName);
                $nameFile = time() . '.png';
            $output_file = 'public/berkas/qr-code/' . $nameFile;
            Storage::disk('local')->put($output_file, $image);
            $modulex = Module::find($module->id);
            $modulex->path_qr = $nameFile;
            $modulex->uniqid = $qrName;
            $modulex->update();
            return redirect()->route('master.module.show', $request->lab_id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $module = Module::find($id);
            if (!$module) {
                return back()->with('success', 'Terjadi kesalahan ');
            }
            $img = Storage::exists('public/berkas/' . $module->path_image);
            if ($img) {
                Storage::delete('public/berkas/' . $module->path_image);
            }
            $doc  = Storage::exists('public/berkas/dokumen/' . $module->path_file);
            if ($doc) {
                Storage::delete('public/berkas/dokumen/' . $module->path_file);
            }

            $module->delete();
            return back()->with('success', 'Berhasil menghapus module ' . $module->name);
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus module');
        }
    }

    public function listModule(Request $request)
    {
        $module = Module::where('lab_id', $request->lab_id)->get();
        if ($module) {
            return response()->json([
                'status' => 'success',
                'data' => $module
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function getModuleById($id)
    {
        $module = Module::with('lab')->find($id);
        if(!$module){
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ]);    
        }
        return response()->json([
            'status' => 'success',
            'data' => $module
        ]);
    }
}
