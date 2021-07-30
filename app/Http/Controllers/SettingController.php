<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Settings()
    {
        $Setting = Setting::find(session('Data.id'));
        // return $BirthdaySetting;
        return view('setting.settings', ['Setting' => $Setting]);
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

    public function SMSSetting(Request $request)
    {
        $SMSSetting = Setting::find(session('Data.id'));
        $SMSSetting->primary_number_2 = ($request->primary_number_2 == 'on') ? 'Y' : 'N';
        $SMSSetting->secondary_number_1 = ($request->secondary_number_1 == 'on') ? 'Y' : 'N';
        $SMSSetting->secondary_number_2 = ($request->secondary_number_2 == 'on') ? 'Y' : 'N';

        if ($SMSSetting->save()) {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'SMS setting saved.');
        } else {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'SMS setting saved.');
        }
    }
}
