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

    public function StudentsAssignedToSubject($id)
    {
        if ($id != "") {
            return Mobiledatas::join('student_teacher_subject_junction', 'student_teacher_subject_junction.mobiledata_id', '=', 'mobiledatas.id')
                ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                ->join('subjects', 'student_teacher_subject_junction.subject_id', '=', 'subjects.id')
                ->select('mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.parent_first_name', 'mobiledatas.parent_last_name', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2', 'subjects.name AS subject_name', 'groups.name AS group_name', 'sections.name AS section_name')
                ->where('student_teacher_subject_junction.user_id', session('Data.user_id'))
                ->where('student_teacher_subject_junction.teacher_id', session('Data.id'))
                ->where('student_teacher_subject_junction.subject_id', $id)
                ->where('mobiledatas.active', 'Y')
                ->get();
        }
        return [];
    }
}
