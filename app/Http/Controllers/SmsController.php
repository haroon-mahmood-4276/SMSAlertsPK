<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\MobileDatas;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function index()
    {
        $Sms = Sms::select('id', 'sms', 'created_at')->where('user_id', '=', '1');
        $Sms = $Sms->addSelect(['phone_number' => MobileDatas::select('parent_mobile_1')->whereColumn('id', '=', 'sms.data_id')])->orderBy('created_at')->get();
        return $Sms;

        return view('sms.index', ['SMSs' => $Sms]);
    }
}
