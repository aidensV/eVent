<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function index()
    {
        
    }
    public function store(Request $request)
    {
        try {
            $history = new History;
            $history->date = $request->date;
            $history->desc_1 = $request->desc_1;
            $history->desc_2 = $request->desc_2;
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
