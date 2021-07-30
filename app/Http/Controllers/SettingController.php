<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Settings()
    {
        return view('setting.settings');
    }

    public function BirthDaySMS(Request $request){
        // return $request->input();


    }
}
