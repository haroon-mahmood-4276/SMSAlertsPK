<?php

namespace App\Http\Controllers;

use App\Models\Mobiledatas;
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
        $BirthdaySetting->parent_secondary_number = ($request->parent_secondary_number == 'on') ? 'Y' : 'N';

        $BirthdaySetting->student_primary_number = ($request->student_primary_number == 'on') ? 'Y' : 'N';
        $BirthdaySetting->student_secondary_number = ($request->student_secondary_number == 'on') ? 'Y' : 'N';


        if ($BirthdaySetting->save()) {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        } else {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        }
    }

    public function Test()
    {
        $Messages = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')->select('mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2','mobiledatas.parent_mobile_1','mobiledatas.parent_mobile_2', 'users.company_name', 'users.mobile_1', 'users.mobile_2', 'users.company_email')->where('dob', '=', '1999-07-06')->where('active', '=', 'Y')->get();

        return $Messages;
    }
}
