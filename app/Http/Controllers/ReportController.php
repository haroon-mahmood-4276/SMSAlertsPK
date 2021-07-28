<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Sms;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function TodaySummery()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->where('created_at', '>', Carbon::today())->get();
        return view('reports.report', ['SMSHistoryData' => $SMSHistoryData, 'Title' => "Today's Report", 'DownloadLink' => route('r.todaysummerypdf')]);
    }

    public function TodaySummeryPDF()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->where('created_at', '>', Carbon::today())->get();
        return PDF::loadView('reports.report', ['SMSHistoryData' => $SMSHistoryData, 'Title' => "Today's Report", 'DownloadLink' => route('r.todaysummerypdf')])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')->download('TodaySummeryReport.pdf');
    }

    public function PersonalizedReport(Request $request)
    {
        if (count($request->input()) > 0) {
            // dd($request->all());
            $request->validate([
                'phone_number' => 'nullable|digits:12',
            ]);
            $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'));
            if ($request->has('start_date') && $request->start_date != null) {
                $SMSHistoryData = $SMSHistoryData->where('created_at', '>', new Carbon($request->start_date));
            }
            if ($request->has('end_date') && $request->end_date != null) {
                $SMSHistoryData = $SMSHistoryData->where('created_at', '<', (new Carbon($request->end_date))->addHours(23)->addMinutes(59)->addSeconds(59));
            }
            if ($request->has('phone_number') && $request->phone_number != null) {
                $SMSHistoryData = $SMSHistoryData->where('phone_number', '=', $request->phone_number);
            }
            return view('reports.report', ['SMSHistoryData' => $SMSHistoryData->get(), 'Title' => "Personalized Report", 'DownloadLink' => route('r.personalizedreportpdf', $request->all())]);
        } else {
            $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
            return view('reports.personalizedreport', ['Groups' => $Groups]);
        }
    }

    public function PersonalizedReportPDF(Request $request)
    {
        $request->validate([
            'phone_number' => 'nullable|digits:12',
        ]);
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'));
        if ($request->has('start_date') && $request->start_date != null) {
            $SMSHistoryData = $SMSHistoryData->where('created_at', '>', new Carbon($request->start_date));
        }
        if ($request->has('end_date') && $request->end_date != null) {
            $SMSHistoryData = $SMSHistoryData->where('created_at', '<', new Carbon($request->end_date));
        }
        if ($request->has('phone_number') && $request->phone_number != null) {
            $SMSHistoryData = $SMSHistoryData->where('phone_number', '=', $request->phone_number);
        }
        return PDF::loadView('reports.report', ['SMSHistoryData' => $SMSHistoryData->get(), 'Title' => "Personalized Report", 'DownloadLink' => route('r.personalizedreportpdf', $request->all())])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')->download('PersonalizedReport.pdf');
    }
}
