<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\DuesImport;
use App\Jobs\JobMain;
use App\Jobs\JobSendSms;
use App\Models\Group;
use App\Models\Mobiledatas;
use App\Models\Sms;
use App\Models\Template;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SmsController extends Controller
{
    public function QuickSMS(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'bail|numeric|digits:12',
            'message' => 'bail|required',
        ]);

        if ($validator->fails())
            return response()->json(['message' => $validator->errors()], 422);

        $User = User::find($request->user_id);
        // return $request->input();
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                $Msgs = intval(((Str::length($request->message) / 160) + 1));
                if ($Msgs <= $User->remaining_of_sms) {

                    $response =  Http::get('http://sms.web.pk/sendsms.php', [
                        'username' => $User->company_username,
                        'password' => $User->company_password,
                        'sender' => $User->company_mask_id,
                        'phone' => $request->phone_number,
                        'message' => $request->message,
                    ]);

                    // $response = "success";
                    $SMS = new Sms();
                    $SMS->user_id = session('Data.id');
                    $SMS->sms = $request->message;
                    $SMS->phone_number = $request->phone_number;
                    $SMS->response = $response;

                    $User = User::find($request->user_id);
                    $User->remaining_of_sms = $User->remaining_of_sms - $Msgs;

                    if ($SMS->save() && $User->save()) {
                        return response()->json(['message' => 'success', 'data' => 'message sent.'], 200);
                    } else {
                        return response()->json(['message' => 'message not sent.'], 404);
                    }
                }
            }
        }
    }

    // public function BulkSMS(Request $request)
    // {
    //     // return $request->input();

    //     JobMain::dispatch(session('Data'), $request->all());
    //     return redirect()->route('r.bulksmsshow')->with('AlertType', 'success')->with('AlertMsg', "Messages will be sent shortly");
    // }
}
