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
        try {
            if (!request()->ajax()) {
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

                dd($request->post());

                $response = (new Mobiledatas())->storeMobileData($request->post());

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
        // return session('Data');
        return "asdasdasd";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decryptParams($id);

        $MobileDatas = MobileDatas::find($id);
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE') {
            $Sections = Section::select('id', 'name')->where('group_id', '=', $MobileDatas->group_id)->where('user_id', '=', session('Data.id'))->get();
            return view('mobiledata.edit', ['Groups' => $Groups, 'Sections' => $Sections, 'MobileData' => $MobileDatas]);
        } else
            return view('mobiledata.edit', ['Groups' => $Groups, 'MobileData' => $MobileDatas]);
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

        $MobileDatas =  MobileDatas::find($id);
        // $MobileDatas->code = $request->code;
        $MobileDatas->student_first_name = $request->student_first_name;
        $MobileDatas->student_last_name = $request->student_last_name;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;
        $MobileDatas->dob = $request->dob;
        // $MobileDatas->cnic = $request->cnic;
        $MobileDatas->gender = $request->gender;
        $MobileDatas->parent_first_name = $request->parent_first_name;
        $MobileDatas->parent_last_name = $request->parent_last_name;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->group_id = $request->group;
        $MobileDatas->section_id = $request->section;
        $MobileDatas->active = $request->active;


        if ($MobileDatas->save()) {
            return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decryptParams($id);
        $MobileDatas =  MobileDatas::find($id);

        if ($MobileDatas->delete()) {
            return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }

    public function deleteAll(Request $request)
    {
        // return $request->members_ids;
        $AlertType = "";
        $AlertMsg = "";
        try {
            if ($request->members_ids != null) {
                $request->members_ids = array_map('decryptParams', $request->gromembers_idsup_ids);
                Mobiledatas::whereIn('id', $request->members_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000) {
                $AlertType = "danger";
                $AlertMsg = "These selected students linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('data.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
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
}
