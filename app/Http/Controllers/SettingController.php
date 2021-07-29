<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Settings(Request $request)
    {
        return view('setting.settings');
    }
}
