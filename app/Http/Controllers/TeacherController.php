<?php

namespace App\Http\Controllers;

use App\Jobs\JobSendSms;
use App\Models\{Setting, StudentTeacherSubjectJunction, Subject, Teacher, TeacherAttendance, User};
use App\Rules\CheckTeacherCode;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\{Str, Facades\Hash};

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Teachers = Teacher::join('student_teacher_subject_junction', 'student_teacher_subject_junction.teacher_id', '=', 'teachers.id')
        //     ->select('teachers.code', 'teachers.first_name', 'teachers.last_name', 'teachers.email', 'teachers.mobile_1', 'teachers.mobile_2', 'teachers.coodinator_number', 'teachers.active')
        //     ->where('teachers.user_id', session('Data.id'))->distinct()->get();

        $Teachers = Teacher::select('id', 'code', 'first_name', 'last_name', 'email', 'mobile_1', 'mobile_2', 'coodinator_number', 'active')->where('user_id', '=', session('Data.id'))->get();

        return view('teacher.index', ['Teachers' => $Teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Subjects = Subject::join('groups', 'subjects.group_id', '=', 'groups.id')->select('subjects.*', 'groups.name AS group_name')->where('subjects.user_id', session('Data.id'))->get();
        return view('teacher.create', ['Subjects' => $Subjects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckTeacherCode(session('Data.id'))],
            'first_name' => 'bail|required|string|between:1,50',
            'last_name' => 'bail|required|string|between:1,50',
            'mobile_1' => 'bail|required|numeric|digits:12',
            'mobile_2' => 'bail|nullable|numeric|digits:12',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'bail|required|alpha_dash|between:5,15',
            'coodinator_number' => 'bail|numeric|digits:12',
            'active' => 'required',
        ]);

        $Teacher = new Teacher;
        $Teacher->user_id = session('Data.id');
        $Teacher->code = $request->code;
        $Teacher->first_name = $request->first_name;
        $Teacher->last_name = $request->last_name;
        $Teacher->mobile_1 = $request->mobile_1;
        $Teacher->mobile_2 = $request->mobile_2;
        $Teacher->email = $request->email;
        $Teacher->password = Hash::make($request->password);
        $Teacher->coodinator_number = $request->coodinator_number;
        $Teacher->active = $request->active;

        if ($Teacher->save()) {

            foreach ($request->input() as $Data) {
                if (substr($Data, 0, 5) == 'stdid') {
                    $Array = array_map('trim', explode('_', substr($Data, 5)));

                    $Junction = new StudentTeacherSubjectJunction;
                    $Junction->user_id = session('Data.id');
                    $Junction->teacher_id = Teacher::where('code', '=', $request->code)->first()->id;
                    $Junction->subject_id = $Array[0];
                    $Junction->mobiledata_id = $Array[1];
                    $Junction->save();
                }
            }

            return redirect()->route('teachers.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('teachers.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Teacher::where('user_id', session('Data.id'))->where('code', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Teacher = Teacher::where('user_id', session('Data.id'))->where('code', $id)->first();
        $Subjects = Subject::join('groups', 'subjects.group_id', '=', 'groups.id')->select('subjects.*', 'groups.name AS group_name')->where('subjects.user_id', session('Data.id'))->get();

        $Students = StudentTeacherSubjectJunction::join('mobiledatas', 'student_teacher_subject_junction.mobiledata_id', '=', 'mobiledatas.id')
            ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
            ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
            ->join('subjects', 'student_teacher_subject_junction.subject_id', '=', 'subjects.id')
            ->select('student_teacher_subject_junction.subject_id', 'mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'groups.name AS group_name', 'sections.name AS section_name', 'subjects.name AS subject_name')
            ->where('student_teacher_subject_junction.user_id', session('Data.id'))
            ->where('student_teacher_subject_junction.teacher_id', $Teacher->id)
            ->get();

        return view('teacher.edit', ['Teacher' => $Teacher, 'Subjects' => $Subjects, 'Students' => $Students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckTeacherCode(session('Data.id'), true)],
            'first_name' => 'bail|required|string|between:1,50',
            'last_name' => 'bail|required|string|between:1,50',
            'mobile_1' => 'bail|required|numeric|digits:12',
            'mobile_2' => 'bail|nullable|numeric|digits:12',
            'email' => 'required|email',
            'password' => 'bail|sometimes|alpha_dash|between:5,15',
            'coodinator_number' => 'bail|numeric|digits:12',
            'active' => 'required',
        ]);

        $Teacher = Teacher::where('user_id', session('Data.id'))->where('code', $id)->first();
        $Teacher->first_name = $request->first_name;
        $Teacher->last_name = $request->last_name;
        $Teacher->mobile_1 = $request->mobile_1;
        $Teacher->mobile_2 = $request->mobile_2;
        $Teacher->email = $request->email;
        if (Str::length($request->password) > 0) {
            $Teacher->password = Hash::make($request->password);
        }
        $Teacher->coodinator_number = $request->coodinator_number;
        $Teacher->active = $request->active;

        if ($Teacher->save()) {
            StudentTeacherSubjectJunction::where('user_id', session('Data.id'))->where('teacher_id', $Teacher->id)->delete();
            foreach ($request->input() as $Data) {
                if (substr($Data, 0, 5) == 'stdid') {
                    $Array = array_map('trim', explode('_', substr($Data, 5)));

                    $Junction = new StudentTeacherSubjectJunction;
                    $Junction->user_id = session('Data.id');
                    $Junction->teacher_id = Teacher::where('code', '=', $request->code)->first()->id;
                    $Junction->subject_id = $Array[0];
                    $Junction->mobiledata_id = $Array[1];
                    $Junction->save();
                }
            }
            return redirect()->route('teachers.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('teachers.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Teacher = Teacher::where('user_id', session('Data.id'))->where('code', $id)->first();

        if ($Teacher->delete()) {
            return redirect()->route('teachers.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('teachers.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }

    public function deleteAll(Request $request)
    {
        // return $request->teacher_ids;
        $AlertType = "";
        $AlertMsg = "";
        try {
            if ($request->teacher_ids != null) {
                Teacher::whereIn('id', $request->teacher_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000) {
                $AlertType = "danger";
                $AlertMsg = "These selected sections linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('teachers.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }

    public function TeacherAttendanceView()
    {
        $TeacherSubjects =
            StudentTeacherSubjectJunction::join('subjects', 'student_teacher_subject_junction.subject_id', '=', 'subjects.id')
            ->join('groups', 'subjects.group_id', '=', 'groups.id')
            ->select('student_teacher_subject_junction.subject_id', 'groups.name AS group_name', 'subjects.name AS subject_name')
            ->where('student_teacher_subject_junction.teacher_id', session('Data.id'))
            ->distinct()
            ->get();

        return view('teacher.attendance', ['TeacherSubjects' => $TeacherSubjects]);
    }

    public function TeacherAttendance(Request $request)
    {
        $IsMessageSent = true;
        $User = User::find(session('Data.user_id'));

        $UserSettings = Setting::where('user_id', session('Data.user_id'))->first();

        $StudentRecords = app('App\Http\Controllers\AjaxController')->StudentsAssignedToSubject($request->subject);
        $Subject = Subject::where('user_id', '=', session('Data.user_id'))->where('id', '=', $request->subject)->first();
        foreach ($StudentRecords as $Record) {

            $TeacherAttendance = new TeacherAttendance;
            $TeacherAttendance->user_id = session('Data.user_id');
            $TeacherAttendance->teacher_id = session('Data.id');
            $TeacherAttendance->subject_id = $request->subject;
            $TeacherAttendance->mobiledata_id = $Record->id;
            $TeacherAttendance->status = $request->input($Record->code . 'chk');
            $TeacherAttendance->save();

            if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
                if ($User->remaining_of_sms > 0) {
                    if ($UserSettings->attendance_enabled == "Y") {
                        if ($request->input($Record->code . 'chk') == "A") {
                            $ReplacedMessage = "";
                            $ReplacedMessage = str_replace('[student_full_name]', $Record->student_first_name . " " . $Record->student_last_name, $UserSettings->attendance_message);
                            $ReplacedMessage = str_replace('[class_name]', $Record->group_name, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[section_name]', $Record->section_name, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[father_full_name]', $Record->parent_first_name . " " . $Record->parent_last_name, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[subject_name]', $Subject->name, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[school_name]', $User->company_name, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[school_phone_1]', $User->mobile_1, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[school_phone_2]', $User->mobile_2, $ReplacedMessage);
                            $ReplacedMessage = str_replace('[school_email]', $User->company_email, $ReplacedMessage);

                            if ($UserSettings->attendance_parent_primary_number == "Y")
                                if ($Record->parent_mobile_1 != null && $Record->parent_mobile_1 != '')
                                    JobSendSms::dispatch($User->id, $User->company_username, $User->company_password, $User->company_mask_id, $Record->parent_mobile_1, $ReplacedMessage);

                            if ($UserSettings->attendance_parent_secondary_number == "Y")
                                if ($Record->parent_mobile_2 != null && $Record->parent_mobile_2 != '')
                                    JobSendSms::dispatch($User->id, $User->company_username, $User->company_password, $User->company_mask_id, $Record->parent_mobile_2, $ReplacedMessage);
                        }
                    }
                } else
                    $IsMessageSent = false;

                $Message = session('Data.first_name') . " " . session('Data.last_name') . " has marked the Attendance.";
                if (session('Data.coodinator_number') != null && session('Data.coodinator_number') != '')
                    JobSendSms::dispatch($User->id, $User->company_username, $User->company_password, $User->company_mask_id, session('Data.coodinator_number'), $Message);
            }
            if ($IsMessageSent) {
                return redirect()->route('r.teacher-attendance-view')->with('AlertType', 'success')->with('AlertMsg', "Attendance Saved.");
            } else
                return redirect()->route('r.teacher-attendance-view')->with('AlertType', 'info')->with('AlertMsg', 'Attendance Saved. Something went wrong');
        }
    }
}
