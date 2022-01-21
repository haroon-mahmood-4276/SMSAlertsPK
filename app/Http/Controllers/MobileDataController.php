<?php

namespace App\Http\Controllers;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\CheckMemberCode;
use Exception;
use Illuminate\Http\Request;

class MobileDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (!request()->ajax()) {
                $data = [
                    'groups' => (new Group)->getAll(),
                    'members' => (new Mobiledatas)->getMembersWithGroups($request, 50),
                    'group_id' => $request->group_id,
                ];

                return view('mobiledata.index', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if (!request()->ajax()) {
                $data = [
                    'groups' => (new Group)->getAll(),
                    'sections' => (new Section)->getAll(),
                ];

                return view('mobiledata.create', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE') {

            $request->validate([
                'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode()],
                'student_first_name' => 'bail|required|string|between:1,50',
                'student_last_name' => 'bail|required|string|between:1,50',
                'student_mobile_1' => 'bail|required|numeric|digits:12',
                'student_mobile_2' => 'bail|nullable|numeric|digits:12',
                'dob' => 'bail|required',
                'gender' => 'required',
                'parent_first_name' => 'bail|required|string|between:1,50',
                'parent_last_name' => 'bail|required|string|between:1,50',
                'parent_mobile_1' => 'required|numeric|digits:12',
                'parent_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'section' => 'required',
                'active' => 'required',
            ]);
        } else {
            $request->validate([
                'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode()],
                'student_first_name' => 'bail|required|string|between:1,50',
                'student_last_name' => 'bail|required|string|between:1,50',
                'dob' => 'bail|required',
                'gender' => 'required',
                'student_mobile_1' => 'required|numeric|digits:12',
                'student_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'active' => 'required',
            ]);
            // dd($request->input());

            $request->parent_mobile_1 = $request->student_mobile_1;
            $request->parent_mobile_2 = $request->student_mobile_2;
        }
        try {
            if (!request()->ajax()) {
                // dd($request->post());

                $response = (new Mobiledatas())->storeMobileData($request->post());
                // dd($response);
                if ($response) {
                    return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
                } else {
                    return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
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
        $id = decryptParams($id);
        try {
            if (!request()->ajax()) {

                $data = [
                    'mobiledata' => (new MobileDatas())->getById($id),
                    'groups' => (new Group())->getAll(),
                ];

                if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE') {
                    $data['sections'] = (new Section())->getByGroupId($data['mobiledata']->group_id);
                    return view('mobiledata.edit', $data);
                } else
                    return view('mobiledata.edit', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
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
        if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE') {
            $request->validate([
                'student_first_name' => 'bail|required|string|between:1,50',
                'student_last_name' => 'bail|required|string|between:1,50',
                'student_mobile_1' => 'bail|required|numeric|digits:12',
                'student_mobile_2' => 'bail|nullable|numeric|digits:12',
                'dob' => 'bail|required',
                'gender' => 'required',
                'parent_first_name' => 'bail|required|string|between:1,50',
                'parent_last_name' => 'bail|required|string|between:1,50',
                'parent_mobile_1' => 'required|numeric|digits:12',
                'parent_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'section' => 'required',
                'active' => 'required',
            ]);
        } else {
            $request->validate([
                'student_first_name' => 'bail|required|string|between:1,50',
                'student_last_name' => 'bail|required|string|between:1,50',
                'dob' => 'bail|required',
                'gender' => 'required',
                'student_mobile_1' => 'required|digits:12',
                'student_mobile_2' => 'nullable|digits:12',
                'group' => 'required',
                'active' => 'required',
            ]);

            $request->parent_mobile_1 = $request->student_mobile_1;
            $request->parent_mobile_2 = $request->student_mobile_2;
            // dd($request->input());
        }

        try {
            if (!request()->ajax()) {
                // dd($request->post());

                $id = decryptParams($id);

                $response = (new Mobiledatas())->updateMobileData($request->post(), $id);
                // dd($response);
                if ($response) {
                    return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
                } else {
                    return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
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
        try {
            // dd($request->input());
            if (!request()->ajax()) {
                $AlertType = "";
                $AlertMsg = "";
                $response = false;

                if ($request->members_ids != null) {
                    $request->members_ids = array_map('decryptParams', $request->members_ids);
                    $response = (new Mobiledatas())->whereIn('id', $request->members_ids)->delete();
                    $AlertType = "success";
                    $AlertMsg = "Selected data deleted";
                } else {
                    $AlertType = "warning";
                    $AlertMsg = "Please select atleast one row.";
                }

                return redirect()->route('data.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    public function deleteAll(Request $request)
    {
        // dd ($request->members_ids);

        try {
            if (!request()->ajax()) {
                $response = (new Mobiledatas())->deleteAllData();
                $AlertType = "success";
                $AlertMsg = "Data deleted";

                if ($response) {
                    return redirect()->route('data.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
                } else {
                    return redirect()->route('data.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch (Exception $ex) {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    public function STDList($groupid, $sectionid)
    {
        if ($groupid == 0) {
            $MobileDatas = Mobiledatas::where('user_id', '=', session('Data.id'))->where('active', '=', 'Y');
        } else if ($sectionid == 0) {
            $MobileDatas = Mobiledatas::where('user_id', '=', session('Data.id'))->where('group_id', '=', $groupid)->where('active', '=', 'Y');
        } else {
            $MobileDatas = Mobiledatas::where('user_id', '=', session('Data.id'))->where('group_id', '=', $groupid)->where('section_id', '=', $sectionid)->where('active', '=', 'Y');
        }
        $MobileDatas = $MobileDatas->addSelect(['group_name' => Group::select('name')->whereColumn('id', '=', 'mobiledatas.group_id')]);
        $MobileDatas = $MobileDatas->addSelect(['section_name' => Section::select('name')->whereColumn('id', '=', 'mobiledatas.section_id')])->orderBy('section_name')->get();
        return $MobileDatas;
    }

    public function CheckMobileDataCodeExistance(Request $request)
    {
        if ($request->has('code')) {
            $mobiledata = (new Mobiledatas())->checkCode($request->code);

            if ($mobiledata) {
                return response()->json(['This code is taken.']);
            }
            return "true";
        }
    }
}
