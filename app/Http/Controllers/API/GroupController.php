<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Rules\API\GroupCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(['message' => 'success', 'data' => Group::select('code', 'name')->where('user_id', '=', $request->user_id)->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['bail', 'required', 'numeric', 'digits:5', new GroupCode($request->user_id)],
            'name' => ['bail', 'required', 'between:1,50']
        ]);

        if ($validator->fails())
            return response()->json(['message' => $validator->errors()], 422);

        if (Group::create($request->input())) {
            return response()->json(['message' => 'data saved.'], 201);
        } else {
            return response()->json(['message' => 'data not saved'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $Group = Group::select('code', 'name')->where('user_id', '=', $request->user_id)->where('code', '=', $id)->first();
        if ($Group)
            return response()->json(['message' => 'success', 'data' => $Group], 200);
        else
            return response()->json(["message" => "record not found"], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'between:1,50']
        ]);

        if ($validator->fails())
            return response()->json(['message' => $validator->errors()], 422);

        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $id)->first();
        if ($Group) {

            $Group->name = $request->name;
            if ($Group->save()) {
                return response()->json(['message' => 'data saved.'], 200);
            } else {
                return response()->json(['message' => 'data not saved'], 400);
            }
        } else {
            return response()->json(["message" => "record not found"], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $Group = Group::where('user_id', '=', $request->user_id)->where('code', '=', $id)->first();
        if ($Group) {
            if ($Group->delete()) {
                return response()->json(['message' => 'data deleted.'], 410);
            } else {
                return response()->json(['message' => 'data not deleted'], 400);
            }
        } else {
            return response()->json(["message" => "record not found"], 404);
        }
    }
}
