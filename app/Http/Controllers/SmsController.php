<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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

        JobMain::dispatch(session('Data'), $request->all());
        return redirect()->route('r.bulksmsshow')->with('AlertType', 'success')->with('AlertMsg', "Messages will be sent shortly");
    }

    public function ShowDuesSMS()
    {
        $User = User::find(session('Data.id'));
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {
                $Templates = Template::where('user_id', '=', session('Data.id'))->get();

                return view('sms.duessms', ['DuesData' => [], 'Templates' => $Templates, 'Template_Code' => 0, 'Message' => '']);
            } else
                return redirect()->route('r.dashboard')->with('AlertType', 'info')->with('AlertMsg', 'Please! Renew the SMS Package first');
        }
    }

    public function DuesSMS(Request $request)
    {
        if (isset($request->fileupload)) {
            if ($request->duesfile != null) {
                $DuesData = Excel::toArray(new DuesImport, $request->file('duesfile'));
                $newArray = [];
                foreach ($DuesData as $array) {
                    foreach ($array as $k => $v) {
                        $newArray[$k] = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')
                            ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                            ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                            ->select('mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2', 'mobiledatas.parent_first_name', 'mobiledatas.parent_last_name', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2', 'mobiledatas.active', 'groups.name AS group_name', 'sections.name AS section_name')
                            ->where('mobiledatas.user_id', '=', session('Data.id'))
                            ->where('mobiledatas.code', '=', $v['student_code'])->get();
                        $newArray[$k]['dues'] = $v['dues'];
                    }
                }

                session()->put(['DuesData' => $newArray]);
                $Templates = Template::where('user_id', '=', session('Data.id'))->get();

                return view('sms.duessms', ['DuesData' => $newArray, 'Templates' => $Templates, 'Template_Code' => $request->template, 'Message' => $request->message]);
            } else
                return redirect()->route('r.smsdues')->with('AlertType', 'info')->with('AlertMsg', "Upload file first.");
        } else {
            if ($request->session()->has('DuesData')) {

                foreach (session('DuesData') as $Member) {

                    if (Arr::exists($request->input(), $Member[0]->id . 'chk')) {

                        $ReplacedMessage = "";

                        $ReplacedMessage = str_replace('[student_full_name]', $Member[0]->student_first_name . " " . $Member[0]->student_last_name, $request->message);
                        $ReplacedMessage = str_replace('[class_name]', $Member[0]->group_name, $ReplacedMessage);
                        $ReplacedMessage = str_replace('[section_name]', $Member[0]->section_name, $ReplacedMessage);
                        $ReplacedMessage = str_replace('[school_name]', session('Data.company_name'), $ReplacedMessage);
                        $ReplacedMessage = str_replace('[school_phone_1]', session('Data.mobile_1'), $ReplacedMessage);
                        $ReplacedMessage = str_replace('[school_phone_2]', session('Data.mobile_2'), $ReplacedMessage);
                        $ReplacedMessage = str_replace('[school_email]', session('Data.company_email'), $ReplacedMessage);
                        $ReplacedMessage = str_replace('[dues]', $Member['dues'], $ReplacedMessage);
                        // return $ReplacedMessage;

                        JobSendSms::dispatch(session('Data.id'), session('Data.company_username'), session('Data.company_password'), session('Data.company_mask_id'), $Member[0]->parent_mobile_1, $ReplacedMessage);

                        if (isset($this->RequestInput['parent_secondary_number']) && $request->parent_secondary_number == "on")
                            if ($Member[0]->parent_mobile_2 != null && $Member[0]->parent_mobile_2 != '')
                                JobSendSms::dispatch(session('Data.id'), session('Data.company_username'), session('Data.company_password'), session('Data.company_mask_id'), $Member[0]->parent_mobile_2, $ReplacedMessage);

                        if (isset($this->RequestInput['student_primary_number']) && $request->student_primary_number == "on")
                            if ($Member[0]->student_mobile_1 != null && $Member[0]->student_mobile_1 != '')
                                JobSendSms::dispatch(session('Data.id'), session('Data.company_username'), session('Data.company_password'), session('Data.company_mask_id'), $Member[0]->student_mobile_1, $ReplacedMessage);

                        if (isset($this->RequestInput['student_secondary_number']) && $request->student_secondary_number == "on")
                            if ($Member[0]->student_mobile_2 != null && $Member[0]->student_mobile_2 != '')
                                JobSendSms::dispatch(session('Data.id'), session('Data.company_username'), session('Data.company_password'), session('Data.company_mask_id'), $Member[0]->student_mobile_2, $ReplacedMessage);
                    }
                }
            }
        }
        if ($request->session()->has('DuesData')) {
            Session()->forget('DuesData');
        }

        return redirect()->route('r.smsdues')->with('AlertType', 'success')->with('AlertMsg', "Messages will be sent shortly");
    }
}
