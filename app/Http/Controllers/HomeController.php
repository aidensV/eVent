<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Lab;
use App\Models\Module;
use App\Models\Prodi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::count();
        $users = User::count() ;
        $labs = Lab::count();
        $prodis = Prodi::count();
        $reports = History::with('user.prodis')->whereMonth('date',Carbon::now()->format('m'))
        ->with('module')
        ->orderBy('date','DESC')->get();
        return view('home',compact('modules','users','labs','prodis','reports'));
    }
}
