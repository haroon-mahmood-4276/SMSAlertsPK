<?php

namespace App\Http\Controllers;

use App\Models\Mobiledatas;
use App\Models\Sms;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportPDFController extends Controller
{
    public function TodaySummeryPDF()
    {
        $SMSHistoryData = Sms::select('id', 'sms', 'response', 'phone_number', 'created_at')->where('user_id', '=', session('Data.id'))->where('created_at', '>', Carbon::today())->orderBy('created_at', 'desc')->get();
        return PDF::loadView('reports.report', ['SMSHistoryData' => $SMSHistoryData, 'Title' => "Today's Report", 'DownloadLink' => route('r.todaysummerypdf')])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')->download('TodaySummeryReport.pdf');
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

    public function BirthdayAsPDF()
    {
        $BirthdayData = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')
            ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
            ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
            ->select('mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.dob', 'groups.name AS group_name', 'sections.name AS section_name')
            ->where('mobiledatas.user_id', '=', session('Data.id'))
            ->where('mobiledatas.dob', '=', Carbon::today()->toDateString())
            ->where('mobiledatas.active', '=', 'Y')->get();

        return PDF::loadView('reports.birthdays', ['BirthdayData' => $BirthdayData, 'Title' => "Birthday Report"])->setOptions(['defaultFont' => 'sans-serif'])->setPaper('a4', 'landscape')->download('Birthday Report.pdf');
    }
}
