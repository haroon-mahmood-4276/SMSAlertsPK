<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Section;
use App\Rules\API\SectionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $class_code)
    {
        $Class = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Class) {
            $Sections = Section::join('groups', 'sections.group_id', '=', 'groups.id')
                ->select('groups.name AS class_name', 'sections.code', 'sections.name')
                ->where('sections.user_id', '=', $request->user_id)
                ->where('sections.group_id', '=', $Class->id)
                ->orderBy('class_name')->get();

            return response()->json(['message' => 'success', 'data' => $Sections], 200);
        } else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $class_code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Group) {
            $validator = Validator::make($request->all(), [
                'code' => ['bail', 'required', 'numeric', 'digits:5', new SectionCode($request->user_id, $Group->id)],
                'name' => ['bail', 'required', 'between:1,50']
            ]);

            if ($validator->fails())
                return response()->json(['message' => $validator->errors()], 422);

            $Section = new Section();
            $Section->user_id = $request->user_id;
            $Section->group_id = $Group->id;
            $Section->code = $request->code;
            $Section->name = $request->name;

            if ($Section->save()) {
                return response()->json(['message' => 'data saved.'], 201);
            } else {
                return response()->json(['message' => 'data not saved.'], 400);
            }
        } else {
            return response()->json(['message' => 'this class code does not exist.'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $class_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Group)
            return response()->json(['message' => 'success', 'data' => Section::join('groups', 'sections.group_id', '=', 'groups.id')->select('groups.name AS class_name', 'sections.code', 'sections.name')->where('sections.user_id', '=', $request->user_id)->where('sections.group_id', '=', $Group->id)->where('sections.code', '=', $code)->first()], 200);
        else
            return response()->json(['message' => 'this class code does not exist.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Group) {
            $validator = Validator::make($request->all(), [
                'name' => ['bail', 'required', 'between:1,50']
            ]);

            if ($validator->fails())
                return response()->json(['message' => $validator->errors()], 422);

            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Group->id)->where('code', '=', $code)->first();
            $Section->name = $request->name;

            if ($Section->save()) {
                return response()->json(['message' => 'data updated.'], 201);
            } else {
                return response()->json(['message' => 'data not updated.'], 400);
            }
        } else {
            return response()->json(['message' => 'this class code does not exist.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $class_code, $code)
    {
        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $class_code)->first();
        if ($Group) {
            $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Group->id)->where('code', '=', $class_code)->first();
            if ($Group) {

                $Section = Section::where('user_id', '=', $request->user_id)->where('group_id', '=', $Group->id)->where('code', '=', $code)->first();

                if ($Section->delete()) {
                    return response()->json(['message' => 'data deleted.'], 201);
                } else {
                    return response()->json(['message' => 'data not deleted.'], 400);
                }
            } else {
                return response()->json(['message' => 'this section code does not exist.'], 404);
            }
        } else {
            return response()->json(['message' => 'this class code does not exist.'], 404);
        }
    }
}
