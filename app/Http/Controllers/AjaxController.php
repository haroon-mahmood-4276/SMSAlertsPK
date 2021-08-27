<?php

namespace App\Http\Controllers;

use App\Models\{Group, Mobiledatas, Section, Subject};

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function SectionsAgainstSubject($id)
    {
        $Subject = Subject::find($id);
        if ($Subject) {
            $Group = Group::find($Subject->group_id);
            return Section::where('user_id', session('Data.id'))->where('group_id', $Group->id)->get();
        };
        return [];
    }

    public function StudentsAgainstSubject($subject_id, $id)
    {
        // return $subject_id." - ". $id;
        $Subject = Subject::find($subject_id);
        if ($Subject) {

            $Group = Group::find($Subject->group_id);
            $Section = Section::where('user_id', session('Data.id'))->where('group_id', $Group->id)->where('id', $id)->first();
            if ($Section) {
                return Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                    ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                    ->select('mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'groups.name AS group_name', 'sections.name AS section_name')
                    ->where('mobiledatas.user_id', session('Data.id'))
                    ->where('mobiledatas.group_id', $Group->id)
                    ->where('mobiledatas.section_id', $Section->id)
                    ->where('mobiledatas.active', 'Y')
                    ->get();
            }
        }
        return [];
    }
}
