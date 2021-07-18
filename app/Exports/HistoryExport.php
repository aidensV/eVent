<?php

namespace App\Exports;

use App\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HistoryExport implements FromView
{
    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View
    {
        
        return view('report-excel', ['reports'=>$this->data,'title' => 'Laporan Peminjaman ']);
    }
}
