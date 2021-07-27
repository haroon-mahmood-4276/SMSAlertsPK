<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function TodaySummery()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->where('created_at', '>', Carbon::today())->get();
        return view('reports.todaysummery', ['SMSHistoryData' => $SMSHistoryData]);
    }

    public function TodaySummeryPDF()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->where('created_at', '>', Carbon::today())->get();
        return PDF::loadView('reports.todaysummery', ['SMSHistoryData' => $SMSHistoryData])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')->download('TodaySummeryReport<div class="row">.pdf');
    }
}
