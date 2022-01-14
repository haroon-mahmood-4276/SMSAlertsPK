<?php

namespace App\Http\Controllers;

use App\Models\{Group};
use App\Rules\{CheckGroupCode};
use Exception;
use Illuminate\Http\{Request};
use Illuminate\Support\{Str};
use Illuminate\Support\Facades\{Session};

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {
            $data = [
                'groups' => (new Group())->where('user_id', '=', session('Data.id'))->orderBy('code')->paginate(50),
            ];
            return view('group.index', $data);
        } else {
            return ApiErrorResponse('ajax request is not supported');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!request()->ajax()) {
                $request->validate([
                    'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode()],
                    'name' => 'bail|required|between:1,50',
                ]);

                $data = [
                    'user_id' => Session::get('Data.id'),
                    'code' => $request->code,
                    'name' => $request->name,
                ];

                $response = (new Group())->insert($data);

                if ($response) {
                    return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
                } else {
                    return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            if (!request()->ajax()) {

                $data = [
                    'group' => (new Group())->find($id),
                ];
                return view('group.edit', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
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
        // $request->validate([
        //     'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode(true, $id)],
        //     'name' => 'bail|required|between:1,50',
        // ]);

        $Groups = Group::find($id);
        // $Groups->code = $request->code;
        $Groups->name = $request->name;

        if ($Groups->save()) {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->input())
        $AlertType = "";
        $AlertMsg = "";
        try {
            if ($request->group_ids != null) {
                Group::whereIn('id', $request->group_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000 || $ex->getCode() == 42000) {
                $AlertType = "warning";
                $AlertMsg = "These selected " . (session('Data.company_nature') == 'B' ? 'groups' : 'classes') . " linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }

    public function deleteAll()
    {

        try {
            Group::where('user_id', '=', session('Data.id'))->delete();
            $AlertType = "success";
            $AlertMsg = "Data deleted";
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000 || $ex->getCode() == 42000) {
                $AlertType = "warning";
                $AlertMsg = "These selected " . (session('Data.company_nature') == 'B' ? 'groups' : 'classes') . " linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }

    public function CheckGroupCodeExistance(Request $request)
    {
        if ($request->has('code')) {
            $group = (new Group())->checkCode($request->code);

            if ($group) {
                return response()->json(['code' => 'This code is taken.']);
            }
            return "true";
        }
    }
}
