<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\Mobiledatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function index()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->get();
        // return $SMSHistoryData;
        return view('sms.index', ['SMSHistoryData' => $SMSHistoryData]);
    }

    public function QuickSMS(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|digits:12',
            'message' => 'bail|required',
        ]);


        $response =  Http::get('http://sms.web.pk/sendsms.php', [
            'username' => session('Data.company_username'),
            'password' => session('Data.company_password'),
            'sender' => session('Data.company_mask_id'),
            'phone' => $request->phone_number,
            'message' => $request->message,
        ]);

        $SMS = new SMS();
        $SMS->user_id = session('Data.id');
        $SMS->sms = $request->message;
        $SMS->phone_number = $request->phone_number;
        $SMS->response = $response;

        $User = SMS::find(session('Data.id'));
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
        return $PhoneArray;

        foreach ($PhoneArray as $PhoneNumber) {
            $response =  Http::get('http://sms.web.pk/sendsms.php', [
                'username' => session('Data.company_username'),
                'password' => session('Data.company_password'),
                'sender' => session('Data.company_mask_id'),
                'phone' => $PhoneNumber,
                'message' => $request->message,
            ]);
            $SMS = new SMS();
            $SMS->user_id = session('Data.id');
            $SMS->sms = $request->message;
            $SMS->phone_number = $request->phone_number;
            $SMS->response = $response;
            $SMS->save();

            $User = SMS::find(session('Data.id'));
            $User->remaining_of_sms = $User->remaining_of_sms - 1;
            $User->save();
        }
        return redirect()->route('r.smshistory');
    }
}
