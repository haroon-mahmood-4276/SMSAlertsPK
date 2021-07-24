<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherSettingController extends Controller
{
    public function OtherSettings(Request $request)
    {
       return view('others.othersettings');
    }
}
