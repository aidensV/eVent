<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Module;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class HistoryController extends Controller
{

    public function getHistory(Request $request)
    {
        $data = [];
        if($request->user()->type === 'admin'){
            $data = History::where('modul_id',$request->module_id)
            ->with('user.prodis')
            ->with('module')
            ->orderBy('date','DESC')
            // ->limit(10)
            ->first();
            
        }else{
            $data = History::where('modul_id',$request->module_id)
            ->with('user')
            ->with('module.prodis')
            ->orderBy('date','DESC')
            ->first();
        }
        return response()->json([
            'status' => 'success',
	        'data' => $data
            
        ]);
    }

    public function store(Request $request)
    {
        try {
            $modul = Module::with('lab')
            ->find($request->modul_id);

            if(!$modul){
                throw new Exception("Terjadi kesalahan", 400);
            }
            if($modul->lab->prodi_id === $request->user()->prodi){
                throw new Exception("Anda tidak mempunyai akses", 400);
                
            }
            if($request->user()->type === 'admin'){
                throw new Exception("Anda tidak mempunyai akses", 400);
            }

            $history = new History;
            $history->date = $request->date;
            $history->corrective = $request->corrective;
            $history->preventive = $request->preventive;
            $history->user_id = $request->user()->id;
            $history->modul_id = $request->modul_id;
            $history->save();
            return response()->json([
                'status' => 'success',
                'message' => 'History berhasil dibuat',
                'data' => $history
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
                
            ]);
        }
    }

    public function reportHistory(Request $request)
    {
        $params = $request->range;
        $dt = History::with('user.prodis')
            ->with('module')
            ->where('modul_id',$request->module_id)
            ->orderBy('date','DESC');
                
        if($params == '1'){
            $dt = $dt->whereDate('date',Carbon::now()->format('Y-m-d'));
        }else if($params == '7'){
            $dt = $dt->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }else if($params == '30'){
            $dt =$dt->whereMonth('date',Carbon::now()->format('m'));
            
        }
        $dt = $dt->get();
        
        $pdf = PDF::loadview('report',['reports'=>$dt,'title' => 'Laporan Peminjaman ']);
    	return $pdf->download('laporan-peminjaman-pdf');


    }
}
