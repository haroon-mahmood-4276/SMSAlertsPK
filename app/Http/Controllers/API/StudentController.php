<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Mobiledatas;
use App\Models\Section;
use App\Rules\API\StudentCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $class_code, $section_code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Class->id)->where('code', '=', $section_code)->first();
            if ($Section) {

                $Students = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                    ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                    ->select('groups.name AS class_name', 'sections.name AS section_name', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2', 'mobiledatas.dob', 'mobiledatas.gender', 'mobiledatas.parent_first_name', 'mobiledatas.parent_last_name', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2', 'mobiledatas.active')
                    ->where('mobiledatas.user_id', '=', $request->user_id)
                    ->where('mobiledatas.group_id', '=', $Class->id)
                    ->where('mobiledatas.section_id', '=', $Section->id)
                    ->orderBy('class_name')->get();

                return response()->json(['message' => 'success', 'data' => $Students], 200);
            } else
                return response()->json(['message' => 'this section code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $class_code, $section_code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Class->id)->where('code', '=', $section_code)->first();
            if ($Section) {

                $validator = Validator::make($request->all(), [
                    'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new MobileDataCode($request->user_id)],
                    'student_first_name' => 'bail|required|alpha|between:1,50',
                    'student_last_name' => 'bail|required|alpha|between:1,50',
                    'student_mobile_1' => 'bail|required|numeric|digits:12',
                    'student_mobile_2' => 'bail|numeric|digits:12',
                    'dob' => 'bail|required|date|date_format:Y-m-d',
                    'gender' => 'required|size:1',
                    'parent_first_name' => 'bail|required|alpha|between:1,50',
                    'parent_last_name' => 'bail|required|alpha|between:1,50',
                    'parent_mobile_1' => 'required|digits:12',
                    'parent_mobile_2' => 'nullable|digits:12',
                    'active' => 'required',
                ]);

                if ($validator->fails())
                    return response()->json(['message' => $validator->errors()], 422);

                $StudentsData = new Mobiledatas;

                $StudentsData->user_id = $request->user_id;
                $StudentsData->group_id = $Class->id;
                $StudentsData->section_id = $Section->id;

                $StudentsData->code = $request->code;
                $StudentsData->student_first_name = $request->student_first_name;
                $StudentsData->student_last_name = $request->student_last_name;
                $StudentsData->student_mobile_1 = $request->student_mobile_1;
                $StudentsData->student_mobile_2 = $request->student_mobile_2;

                $StudentsData->dob = $request->dob;
                $StudentsData->gender = Str::of($request->gender)->upper();

                $StudentsData->parent_first_name = $request->parent_first_name;
                $StudentsData->parent_last_name = $request->parent_last_name;

                $StudentsData->parent_mobile_1 = $request->parent_mobile_1;
                $StudentsData->parent_mobile_2 = $request->parent_mobile_2;

                $StudentsData->active = $request->active;

                if ($StudentsData->save()) {
                    return response()->json(['message' => 'data saved.'], 201);
                } else {
                    return response()->json(['message' => 'data not saved.'], 400);
                }
            } else
                return response()->json(['message' => 'this section code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $class_code, $section_code, $code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Class->id)->where('code', '=', $section_code)->first();
            if ($Section) {

                $Students = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                    ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                    ->select('groups.name AS class_name', 'sections.name AS section_name', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2', 'mobiledatas.dob', 'mobiledatas.gender', 'mobiledatas.parent_first_name', 'mobiledatas.parent_last_name', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2', 'mobiledatas.active')
                    ->where('sections.user_id', '=', $request->user_id)
                    ->where('sections.group_id', '=', $Class->id)
                    ->where('mobiledatas.code', '=', $code)
                    ->orderBy('class_name')->get();

                return response()->json(['message' => 'success', 'data' => $Students], 200);
            } else
                return response()->json(['message' => 'this section code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_code, $section_code, $code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Class->id)->where('code', '=', $section_code)->first();
            if ($Section) {

                $StudentData = Mobiledatas::where('code', '=', $code)->first();
                if ($StudentData) {

                    $validator = Validator::make($request->all(), [
                        'student_first_name' => 'bail|required|alpha|between:1,50',
                        'student_last_name' => 'bail|required|alpha|between:1,50',
                        'student_mobile_1' => 'bail|required|numeric|digits:12',
                        'student_mobile_2' => 'bail|numeric|digits:12',
                        'dob' => 'bail|required|date|date_format:Y-m-d',
                        'gender' => 'required|size:1',
                        'parent_first_name' => 'bail|required|alpha|between:1,50',
                        'parent_last_name' => 'bail|required|alpha|between:1,50',
                        'parent_mobile_1' => 'required|digits:12',
                        'parent_mobile_2' => 'nullable|digits:12',
                        'active' => 'required',
                    ]);

                    if ($validator->fails())
                        return response()->json(['message' => $validator->errors()], 422);

                    $StudentData->student_first_name = $request->student_first_name;
                    $StudentData->student_last_name = $request->student_last_name;
                    $StudentData->student_mobile_1 = $request->student_mobile_1;
                    $StudentData->student_mobile_2 = $request->student_mobile_2;

                    $StudentData->dob = $request->dob;
                    $StudentData->gender = Str::of($request->gender)->upper();

                    $StudentData->parent_first_name = $request->parent_first_name;
                    $StudentData->parent_last_name = $request->parent_last_name;

                    $StudentData->parent_mobile_1 = $request->parent_mobile_1;
                    $StudentData->parent_mobile_2 = $request->parent_mobile_2;

                    $StudentData->active = $request->active;

                    if ($StudentData->save()) {
                        return response()->json(['message' => 'data saved.'], 201);
                    } else {
                        return response()->json(['message' => 'data not saved.'], 400);
                    }
                } else
                    return response()->json(['message' => 'this stuent code does not exist.'], 404);
            } else
                return response()->json(['message' => 'this section code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $class_code, $section_code, $code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Class->id)->where('code', '=', $section_code)->first();
            if ($Section) {

                $StudentData = Mobiledatas::where('code', '=', $code)->first();
                if ($StudentData) {
                    if ($StudentData->delete()) {
                        return response()->json(['message' => 'data deleted.'], 410);
                    } else {
                        return response()->json(['message' => 'data not deleted.'], 400);
                    }
                } else
                    return response()->json(['message' => 'this stuent code does not exist.'], 404);
            } else
                return response()->json(['message' => 'this section code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }
}
