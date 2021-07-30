<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Settings()
    {
        $BirthdaySetting = Setting::find(session('Data.id'));
        // return $BirthdaySetting;
        return view('setting.settings', ['BirthdaySetting' => $BirthdaySetting]);
    }

    public function BirthDaySMS(Request $request)
    {
        $BirthdaySetting = Setting::find(session('Data.id'));
        $BirthdaySetting->birthday_enabled = ($request->is_enabled == 'on') ? 'Y' : 'N';
        $BirthdaySetting->birthday_message = ($request->has('message')) ? $request->message : null;

        if ($BirthdaySetting->save()) {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        } else {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        }
    }
}
