<?php

namespace App\Helpers;

use App\Models\Prodi;
use App\Modules\Auth\Login\Models\m_menu;


use Auth;
use Session;
use Request;
use Storage;

class Menu
{
    public static function menus()
    {
        return  Prodi::with('labs')->get();
        

    }
}
