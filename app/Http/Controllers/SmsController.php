<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Sms;
use App\Models\Mobiledatas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function index()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->orderby('created_at', 'desc')->get();
        // return $SMSHistoryData;
        return view('sms.index', ['SMSHistoryData' => $SMSHistoryData]);
    }

    public function QuickSMS(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|digits:12',
            'message' => 'bail|required',
        ]);


        // $response =  Http::get('http://sms.web.pk/sendsms.php', [
        //     'username' => session('Data.company_username'),
        //     'password' => session('Data.company_password'),
        //     'sender' => session('Data.company_mask_id'),
        //     'phone' => $request->phone_number,
        //     'message' => $request->message,
        // ]);
        $response = "success";
        $SMS = new SMS();
        $SMS->user_id = session('Data.id');
        $SMS->sms = $request->message;
        $SMS->phone_number = $request->phone_number;
        $SMS->response = $response;

        $User = User::find(session('Data.id'));
        $User->remaining_of_sms = $User->remaining_of_sms - 1;

        if ($SMS->save() && $User->save()) {
            return redirect()->route('r.smshistory')->with('AlertType', 'warning')->with('AlertMsg', $response);
        } else {
            return redirect()->route('r.smshistory')->with('AlertType', 'warning')->with('AlertMsg', $response);
        }
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
            // $response =  Http::get('http://sms.web.pk/sendsms.php', [
            //     'username' => 'test',
            //     'password' => '123456',
            //     'sender' => 'ALERTS',
            //     'phone' => $PhoneNumber,
            //     'message' => $request->message,
            // ]);
            $response = "success";

            $SMS = new SMS();
            $SMS->user_id = session('Data.id');
            $SMS->sms = $request->message;
            $SMS->phone_number = $PhoneNumber;
            $SMS->response = $response;
            $SMS->save();

            $User = User::find(session('Data.id'));
            $User->remaining_of_sms = $User->remaining_of_sms - 1;
            $User->save();
        }
        return redirect()->route('r.smshistory');
    }

    public function BulkSMSShow(Request $request)
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        

        return view('section.create', ['Groups' => $Groups]);
    }

    public function BulkSMS(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
            'message' => 'required',
        ]);


        return redirect()->route('r.smshistory');
    }
}
