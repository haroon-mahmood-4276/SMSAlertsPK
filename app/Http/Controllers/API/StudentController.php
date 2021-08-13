<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Mobiledatas;
use App\Models\Section;
use App\Rules\API\StudentCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                    ->where('sections.user_id', '=', $request->user_id)
                    ->where('sections.group_id', '=', $Class->id)
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
                    'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new StudentCode($request->user_id)],
                    'student_first_name' => 'bail|required|alpha|between:1,50',
                    'student_last_name' => 'bail|required|alpha|between:1,50',
                    'student_mobile_1' => 'bail|required|numeric|digits:12',
                    'student_mobile_2' => 'bail|numeric|digits:12',
                    'dob' => 'bail|required|date',
                    'gender' => 'required',
                    'parent_first_name' => 'bail|required|alpha|between:1,50',
                    'parent_last_name' => 'bail|required|alpha|between:1,50',
                    'parent_mobile_1' => 'required|digits:12',
                    'parent_mobile_2' => 'nullable|digits:12',
                    'active' => 'required',
                ]);

                if ($validator->fails())
                    return response()->json(['message' => $validator->errors()], 422);

                $MobileDatas = new MobileDatas;

                $MobileDatas->user_id = $request->user_id;
                $MobileDatas->group_id = $Class->id;

                $MobileDatas->section_id = $Section->id;
                $MobileDatas->code = $request->code;

                $MobileDatas->student_first_name = $request->student_first_name;
                $MobileDatas->student_last_name = $request->student_last_name;

                $MobileDatas->dob = $request->dob;
                $MobileDatas->gender = $request->gender;

                $MobileDatas->parent_first_name = $request->parent_first_name;
                $MobileDatas->student_mobile_1 = $request->student_mobile_1;

                $MobileDatas->student_mobile_2 = $request->student_mobile_2;
                $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;

                $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
                $MobileDatas->parent_last_name = $request->parent_last_name;
                $MobileDatas->active = $request->active;

                if ($MobileDatas->save()) {
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

                $validator = Validator::make($request->all(), [
                    'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new StudentCode($request->user_id)],
                    'student_first_name' => 'bail|required|alpha|between:1,50',
                    'student_last_name' => 'bail|required|alpha|between:1,50',
                    'student_mobile_1' => 'bail|required|numeric|digits:12',
                    'student_mobile_2' => 'bail|numeric|digits:12',
                    'dob' => 'bail|required|date',
                    'gender' => 'required',
                    'parent_first_name' => 'bail|required|alpha|between:1,50',
                    'parent_last_name' => 'bail|required|alpha|between:1,50',
                    'parent_mobile_1' => 'required|digits:12',
                    'parent_mobile_2' => 'nullable|digits:12',
                    'group' => 'required',
                    'section' => 'required',
                    'active' => 'required',
                ]);

                if ($validator->fails())
                    return response()->json(['message' => $validator->errors()], 422);

                $MobileDatas = new MobileDatas;

                $MobileDatas->user_id = $request->user_id;
                $MobileDatas->group_id = $Class->id;

                $MobileDatas->section_id = $Section->id;
                $MobileDatas->code = $request->code;

                $MobileDatas->student_first_name = $request->student_first_name;
                $MobileDatas->student_last_name = $request->student_last_name;

                $MobileDatas->dob = $request->dob;
                $MobileDatas->gender = $request->gender;

                $MobileDatas->parent_first_name = $request->parent_first_name;
                $MobileDatas->student_mobile_1 = $request->student_mobile_1;

                $MobileDatas->student_mobile_2 = $request->student_mobile_2;
                $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;

                $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
                $MobileDatas->parent_last_name = $request->parent_last_name;
                $MobileDatas->active = $request->active;

                if ($MobileDatas->save()) {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
