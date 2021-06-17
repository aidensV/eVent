<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function getHistory(Request $request)
    {
        $data = [];
        if($request->user()->type === 'admin'){
            $data = History::where('modul_id',$request->module_id)
            ->with('user')
            ->with('module')
            ->orderBy('created_at','DESC')
            ->limit(10)
            ->get();
            
        }else{
            $data = History::where('modul_id',$request->module_id)
            ->with('user')
            ->with('module')
            ->orderBy('created_at','DESC')
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
}
