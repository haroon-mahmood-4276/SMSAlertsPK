<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use PDO;

class SettingController extends Controller
{
    public function Settings()
    {
        $Setting = Setting::where('user_id', '=', session('Data.id'))->first();
        return view('setting.settings', ['Setting' => $Setting]);
    }

    public function BirthDaySMS(Request $request)
    {
        $BirthdaySetting = Setting::where('user_id', '=', session('Data.id'))->first();
        $BirthdaySetting->birthday_enabled = ($request->is_enabled == 'on') ? 'Y' : 'N';

        $BirthdaySetting->birthday_message = ($request->has('message')) ? $request->message : null;
        $BirthdaySetting->parent_secondary_number = ($request->parent_secondary_number == 'on') ? 'Y' : 'N';

        $BirthdaySetting->student_primary_number = ($request->student_primary_number == 'on') ? 'Y' : 'N';
        $BirthdaySetting->student_secondary_number = ($request->student_secondary_number == 'on') ? 'Y' : 'N';


        if ($BirthdaySetting->save()) {
            if (session()->has('Data') && session()->has('UserSettings')) {
                $UserSettings = Setting::where('user_id', session()->get('Data.id'))->first();
                session()->put(['UserSettings' => $UserSettings]);
            }
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        } else {
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Birthday setting saved.');
        }
    }

    public function AttendanceSMS(Request $request)
    {
        // return  $request->input();
        // return  $request->attendance_database_path->extension();
        $AttendanceSetting = Setting::where('user_id', '=', session('Data.id'))->first();
        $AttendanceSetting->attendance_enabled = ($request->attendance_enabled == 'on') ? 'Y' : 'N';

        $AttendanceSetting->attendance_message = ($request->has('attendance_message')) ? $request->attendance_message : null;
        $AttendanceSetting->attendance_parent_primary_number = ($request->attendance_parent_primary_number == 'on') ? 'Y' : 'N';
        $AttendanceSetting->attendance_parent_secondary_number = ($request->attendance_parent_secondary_number == 'on') ? 'Y' : 'N';

        $AttendanceSetting->attendance_database_path_enabled = ($request->attendance_database_path_enabled == 'on') ? 'Y' : 'N';
        $AttendanceSetting->attendance_database_path = ($request->has('attendance_database_path')) ? $request->attendance_database_path : null;

        if ($request->has('attendance_database_path') && !file_exists($request->attendance_database_path)) {
            return redirect()->route('r.settings')->with('AlertType', 'danger')->with('AlertMsg', 'File not found');
        }

        if ($AttendanceSetting->save()) {
            if (session()->has('Data') && session()->has('UserSettings')) {
                $UserSettings = Setting::where('user_id', session()->get('Data.id'))->first();
                session()->put(['UserSettings' => $UserSettings]);
            }
            return redirect()->route('r.settings')->with('AlertType', 'success')->with('AlertMsg', 'Attendance setting saved.');
        } else {
            return redirect()->route('r.settings')->with('AlertType', 'danger')->with('AlertMsg', 'Attendance setting not saved.');
        }
    }
}
