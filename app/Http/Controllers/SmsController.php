<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\MobileDatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsController extends Controller
{
    public function index()
    {
        $Sms = Sms::select('id', 'sms', 'response', 'created_at')->where('user_id', '=', '1');
        $Sms = $Sms->addSelect(['phone_number' => MobileDatas::select('parent_mobile_1')->whereColumn('id', '=', 'sms.data_id')])->orderBy('created_at')->get();
        // return $Sms;

        return view('sms.index', ['SMSs' => $Sms]);
    }

    public function QuickSMS(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|digits:12',
            'message' => 'bail|required',
        ]);


        $response =  Http::get('http://sms.web.pk/sendsms.php', [
            'username' => 'test',
            'password' => '123456',
            'sender' => 'ALERTS',
            'phone' => $request->phone_number,
            'message' => $request->message,
        ]);

        $SMS = new SMS();
        $SMS->user_id = session('Data.id');
        $SMS->sms = $request->message;
        $SMS->phone_number = $request->phone_number;
        $SMS->response = $response;

        if ($SMS->save()) {
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
                'username' => 'test',
                'password' => '123456',
                'sender' => 'ALERTS',
                'phone' => $PhoneNumber,
                'message' => $request->message,
            ]);
            $SMS = new SMS();
            $SMS->user_id = session('Data.id');
            $SMS->sms = $request->message;
            $SMS->phone_number = $request->phone_number;
            $SMS->response = $response;
            $SMS->save();
        }
        return redirect()->route('r.smshistory');
    }
}
