<?php

namespace App\Http\Controllers;

use App\Models\Mobiledatas;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExportPDFController extends Controller
{
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
