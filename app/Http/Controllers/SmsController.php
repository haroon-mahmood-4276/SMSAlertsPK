<?php

namespace App\Http\Controllers;

use App\Jobs\JobMain;
use App\Models\Group;
use App\Models\Sms;
use App\Models\Template;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SmsController extends Controller
{
    // public function index()
    // {
    //     $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->orderby('created_at', 'desc')->get();
    //     // return $SMSHistoryData;
    //     return view('sms.index', ['SMSHistoryData' => $SMSHistoryData]);
    // }

    public function ShowQuickSMS()
    {
        $User = User::find(session('Data.id'));
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                return view('sms.quicksms');
            }
        }
        return redirect()->route('r.dashboard')->with('AlertType', 'info')->with('AlertMsg', 'Please! Renew the SMS Package first');
    }

    public function QuickSMS(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:12',
            'message' => 'bail|required',
        ]);
        $User = User::find(session('Data.id'));
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                $Msgs = intval(((Str::length($this->Message) / 160) + 1));
                if ($Msgs <= $User->remaining_of_sms) {

                    $response =  Http::get('http://sms.web.pk/sendsms.php', [
                        'username' => session('Data.company_username'),
                        'password' => session('Data.company_password'),
                        'sender' => session('Data.company_mask_id'),
                        'phone' => $request->phone_number,
                        'message' => $request->message,
                    ]);

                    // $response = "success";
                    $SMS = new Sms();
                    $SMS->user_id = session('Data.id');
                    $SMS->sms = $request->message;
                    $SMS->phone_number = $request->phone_number;
                    $SMS->response = $response;

                    $User = User::find(session('Data.id'));
                    $User->remaining_of_sms = $User->remaining_of_sms - $Msgs;

                    if ($SMS->save() && $User->save()) {
                        return redirect()->route('r.smshistory')->with('AlertType', 'warning')->with('AlertMsg', $response);
                    } else {
                        return redirect()->route('r.smshistory')->with('AlertType', 'warning')->with('AlertMsg', $response);
                    }
                }
            }
        }
    }

    public function ShowMultipleSMS()
    {
        $User = User::find(session('Data.id'));
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                return view('sms.multiplesms');
            }
        }
        return redirect()->route('r.dashboard')->with('AlertType', 'info')->with('AlertMsg', 'Please! Renew the SMS Package first');
    }

    public function MultipleSMS(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        $PhoneArray = array_map('trim', explode(',', $request->phone_number));
        //return $PhoneArray;

        foreach ($PhoneArray as $PhoneNumber) {

            $User = User::find(session('Data.id'));
            if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
                if ($User->remaining_of_sms > 0) {
                    $Msgs = intval(((Str::length($this->Message) / 160) + 1));
                    if ($Msgs <= $User->remaining_of_sms) {

                        $response =  Http::get('http://sms.web.pk/sendsms.php', [
                            'username' => session('Data.company_username'),
                            'password' => session('Data.company_password'),
                            'sender' => session('Data.company_mask_id'),
                            'phone' => $request->phone_number,
                            'message' => $request->message,
                        ]);
                        // $response = "success";

                        $SMS = new Sms();
                        $SMS->user_id = session('Data.id');
                        $SMS->sms = $request->message;
                        $SMS->phone_number = $PhoneNumber;
                        $SMS->response = $response;
                        $SMS->save();

                        $User = User::find(session('Data.id'));
                        $User->remaining_of_sms = $User->remaining_of_sms - $Msgs;
                        $User->save();
                    }
                }
            }
        }
        return redirect()->route('r.smshistory');
    }

    public function BulkSMSShow()
    {
        $User = User::find(session('Data.id'));
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
                $Templates = Template::where('user_id', '=', session('Data.id'))->get();

                return view('sms.bulksms', ['Groups' => $Groups, 'Templates' => $Templates]);
            } else
                return redirect()->route('r.dashboard')->with('AlertType', 'info')->with('AlertMsg', 'Please! Renew the SMS Package first');
        }
    }

    public function BulkSMS(Request $request)
    {
        // return $request->input();
        $Members = app('App\Http\Controllers\MobileDataController')->STDList($request->group, $request->section);
        JobMain::dispatch(session('Data'), $request->all(), $Members);
        return redirect()->route('r.bulksmsshow')->with('AlertType', 'success')->with('AlertMsg', "Messages will be sent shortly");
    }
}
