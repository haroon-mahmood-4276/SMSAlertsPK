<?php

namespace App\Http\Controllers;

use App\Models\{Group, Mobiledatas, Subject};

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function StudentsAgainstSubject($id)
    {
        return Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
            ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
            ->select('mobiledatas.*', 'groups.name AS group_name', 'sections.name AS section_name')
            ->where('mobiledatas.user_id', session('Data.id'))
            ->where('mobiledatas.group_id', Group::where('user_id', session('Data.id'))
                ->where('id', Subject::find($id)->group_id)->first()->id)
            ->where('mobiledatas.active', 'Y')
            ->get();
    }
}
