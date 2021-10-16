<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Mobiledatas;
use App\Rules\API\MobileDataCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $group_code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $group_code)->first();
        if ($Group) {

            $Members = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                ->select('groups.name AS group_name', 'mobiledatas.code', 'mobiledatas.student_first_name AS member_first_name', 'mobiledatas.student_last_name AS member_last_name', 'mobiledatas.gender', 'mobiledatas.parent_mobile_1 AS member_mobile_1', 'mobiledatas.parent_mobile_2 AS member_mobile_2', 'mobiledatas.active')
                ->where('mobiledatas.user_id', '=', $request->user_id)
                ->where('mobiledatas.group_id', '=', $Group->id)
                ->orderBy('group_name')->get();

            return response()->json(['message' => 'success', 'data' => $Members], 200);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group_code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $group_code)->first();
        if ($Group) {

            $validator = Validator::make($request->all(), [
                'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new MobileDataCode($request->user_id)],
                'member_first_name' => 'bail|required|alpha|between:1,50',
                'member_last_name' => 'bail|required|alpha|between:1,50',
                'gender' => 'required|size:1',
                'member_mobile_1' => 'required|digits:12',
                'member_mobile_2' => 'nullable|digits:12',
                'active' => 'required',
            ]);

            if ($validator->fails())
                return response()->json(['message' => $validator->errors()], 422);

            $MemberData = new Mobiledatas;

            $MemberData->user_id = $request->user_id;
            $MemberData->group_id = $Group->id;
            $MemberData->section_id = null;

            $MemberData->code = $request->code;
            $MemberData->student_first_name = $request->member_first_name;
            $MemberData->student_last_name = $request->member_last_name;
            $MemberData->gender = Str::of($request->gender)->upper();

            $MemberData->parent_mobile_1 = $request->member_mobile_1;
            $MemberData->parent_mobile_2 = $request->member_mobile_1;
            $MemberData->active = $request->active;

            if ($MemberData->save()) {
                return response()->json(['message' => 'data saved.'], 201);
            } else {
                return response()->json(['message' => 'data not saved.'], 400);
            }
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $group_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $group_code)->first();
        if ($Group) {

            $Members = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                ->select('groups.name AS group_name', 'mobiledatas.code', 'mobiledatas.student_first_name AS member_first_name', 'mobiledatas.student_last_name AS member_last_name', 'mobiledatas.gender', 'mobiledatas.parent_mobile_1 AS member_mobile_1', 'mobiledatas.parent_mobile_2 AS member_mobile_2', 'mobiledatas.active')
                ->where('mobiledatas.user_id', '=', $request->user_id)
                ->where('mobiledatas.group_id', '=', $Group->id)
                ->where('mobiledatas.code', '=', $code)
                ->orderBy('group_name')->get();

            return response()->json(['message' => 'success', 'data' => $Members], 200);
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
    public function update(Request $request, $group_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $group_code)->first();
        if ($Group) {

            $MemberData = Mobiledatas::where('code', '=', $code)->first();
            if ($MemberData) {

                $validator = Validator::make($request->all(), [
                    'member_first_name' => 'bail|required|alpha|between:1,50',
                    'member_last_name' => 'bail|required|alpha|between:1,50',
                    'gender' => 'required|size:1',
                    'member_mobile_1' => 'required|digits:12',
                    'member_mobile_2' => 'nullable|digits:12',
                    'active' => 'required',
                ]);

                if ($validator->fails())
                    return response()->json(['message' => $validator->errors()], 422);

                $MemberData->student_first_name = $request->member_first_name;
                $MemberData->student_last_name = $request->member_last_name;
                $MemberData->gender = Str::of($request->gender)->upper();

                $MemberData->parent_mobile_1 = $request->member_mobile_1;
                $MemberData->parent_mobile_2 = $request->member_mobile_1;
                $MemberData->active = $request->active;

                if ($MemberData->save()) {
                    return response()->json(['message' => 'data saved.'], 201);
                } else {
                    return response()->json(['message' => 'data not saved.'], 400);
                }
            } else
                return response()->json(['message' => 'this stuent code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $group_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $group_code)->first();
        if ($Group) {

            $MemberData = Mobiledatas::where('code', '=', $code)->first();
            if ($MemberData) {
                if ($MemberData->delete()) {
                    return response()->json(['message' => 'data deleted.'], 410);
                } else {
                    return response()->json(['message' => 'data not deleted.'], 400);
                }
            } else
                return response()->json(['message' => 'this stuent code does not exist.'], 404);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }
}
