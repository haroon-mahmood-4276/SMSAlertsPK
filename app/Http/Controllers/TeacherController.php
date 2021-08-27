<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\StudentTeacherSubjectJunction;
use App\Models\Subject;
use App\Models\Teacher;
use App\Rules\CheckTeacherCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Teachers = Teacher::join('student_teacher_subject_junction', 'student_teacher_subject_junction.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'student_teacher_subject_junction.subject_id', '=', 'subjects.id')
            ->join('groups', 'subjects.group_id', '=', 'groups.id')
            ->select('teachers.code', 'teachers.first_name', 'teachers.last_name', 'teachers.email', 'teachers.mobile_1', 'teachers.mobile_2', 'teachers.coodinator_number', 'teachers.active', 'subjects.name AS subject_name', 'groups.name AS group_name')
            ->where('teachers.user_id', session('Data.id'))->distinct()->get();


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
        // return $request->input();

        $request->validate([
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckTeacherCode(session('Data.id'))],
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'mobile_1' => 'bail|required|numeric|digits:12',
            'mobile_2' => 'bail|numeric|digits:12',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'bail|required|alpha_num|between:5,15',
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
                if (substr($Data, -6) == 'std_id') {
                    $Junction = new StudentTeacherSubjectJunction;
                    $Junction->user_id = session('Data.id');
                    $Junction->teacher_id = Teacher::where('code', '=', $request->code)->first()->id;
                    $Junction->mobiledata_id = substr($Data, 0, -6);
                    $Junction->subject_id = $request->subject;
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
            ->select('student_teacher_subject_junction.subject_id', 'mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'groups.name AS group_name', 'sections.name AS section_name')
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
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'mobile_1' => 'bail|required|numeric|digits:12',
            'mobile_2' => 'bail|numeric|digits:12',
            'email' => 'required|email',
            'password' => 'bail|nullable|alpha_num|between:5,15',
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


            if (StudentTeacherSubjectJunction::where('user_id', session('Data.id'))->where('teacher_id', $Teacher->id)->delete()) {
                foreach ($request->input() as $Data) {
                    if (substr($Data, -6) == 'std_id') {
                        $Junction = new StudentTeacherSubjectJunction;
                        $Junction->user_id = session('Data.id');
                        $Junction->teacher_id = Teacher::where('code', '=', $request->code)->first()->id;
                        $Junction->mobiledata_id = substr($Data, 0, -6);
                        $Junction->subject_id = $request->subject;
                        $Junction->save();
                    }
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
            return redirect()->route('teachers.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('teachers.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
        }
    }
}
