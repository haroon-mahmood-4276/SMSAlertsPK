<?php

namespace App\Http\Controllers;

use App\Models\{Group, Mobiledatas, Section};
use App\Rules\CheckMemberCode;
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
        $Groups = Group::where('user_id', '=', session('Data.id'))->orderBy('code')->get();
        if ($request->group_id != "") {
            $MobileDatas = Mobiledatas::where('user_id', '=', session('Data.id'))->where('group_id', '=', $request->group_id);
        } else {
            $MobileDatas = Mobiledatas::where('user_id', '=', session('Data.id'));
        }

        $MobileDatas = $MobileDatas->addSelect(['group_name' => Group::select('name')->whereColumn('id', '=', 'mobiledatas.group_id')]);
        $MobileDatas = $MobileDatas->addSelect(['section_name' => Section::select('name')->whereColumn('id', '=', 'mobiledatas.section_id')])->orderBy('section_name')->get();
        // return $MobileDatas;

        // $MobileDatas = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')->join('sections', 'mobiledatas.section_id', '=', 'sections.id')->select('mobiledatas.*', 'groups.name AS group_name', 'sections.name AS section_name')->where('user_id', '=', session('Data.id'))->get();
        //  return $MobileDatas;

        return view('mobiledata.index', ['MobileDatas' => $MobileDatas, 'Groups' => $Groups, 'Current_Code' => $request->group_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        $Sections = Section::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        return view('mobiledata.create', ['Groups' => $Groups, 'Sections' => $Sections]);
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
                'student_last_name' => 'bail|required|alpha|between:1,50',
                'student_mobile_1' => 'bail|required|numeric|digits:12|unique:mobiledatas,student_mobile_1',
                'student_mobile_2' => 'bail|nullable|numeric|digits:12',
                'dob' => 'bail|required',
                // 'cnic' => 'bail|required',
                'gender' => 'required',
                'parent_first_name' => 'bail|required|alpha|between:1,50',
                'parent_last_name' => 'bail|required|alpha|between:1,50',
                'parent_mobile_1' => 'required|numeric|digits:12',
                'parent_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'section' => 'required',
                'active' => 'required',
            ]);
        } else {
            $request->validate([
                'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode()],
                'student_first_name' => 'bail|required|alpha|between:1,50',
                'student_last_name' => 'bail|required|alpha|between:1,50',
                'dob' => 'bail|required',
                // 'cnic' => 'bail|required',
                'gender' => 'required',
                'student_mobile_1' => 'required|numeric|digits:12|unique:mobiledatas,student_mobile_1',
                'student_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'active' => 'required',
            ]);
            // dd($request->input());

            $request->parent_mobile_1 = $request->student_mobile_1;
            $request->parent_mobile_2 = $request->student_mobile_2;
        }


        // dd($request->input());
        $MobileDatas = new MobileDatas;
        $MobileDatas->code = $request->code;
        $MobileDatas->student_first_name = $request->student_first_name;
        $MobileDatas->student_last_name = $request->student_last_name;
        $MobileDatas->dob = $request->dob;
        // $MobileDatas->cnic = $request->cnic;
        $MobileDatas->gender = $request->gender;
        $MobileDatas->parent_first_name = $request->parent_first_name;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->parent_last_name = $request->parent_last_name;
        $MobileDatas->user_id = session('Data.id');
        $MobileDatas->group_id = $request->group;
        $MobileDatas->section_id = $request->section;
        $MobileDatas->active = $request->active;

        if ($MobileDatas->save()) {
            return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
                // 'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode($request->group, $request->section, true, $id)],
                'student_first_name' => 'bail|required|alpha|between:1,50',
                'student_last_name' => 'bail|required|alpha|between:1,50',
                'student_mobile_1' => 'bail|required|numeric|digits:12',
                'student_mobile_2' => 'bail|nullable|numeric|digits:12',
                'dob' => 'bail|required',
                // 'cnic' => 'bail|required',
                'gender' => 'required',
                'parent_first_name' => 'bail|required|alpha|between:1,50',
                'parent_last_name' => 'bail|required|alpha|between:1,50',
                'parent_mobile_1' => 'required|numeric|digits:12',
                'parent_mobile_2' => 'nullable|numeric|digits:12',
                'group' => 'required',
                'section' => 'required',
                'active' => 'required',
            ]);
        } else {
            $request->validate([
                // 'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode($request->group, $request->section, true, $id)],
                'student_first_name' => 'bail|required|alpha|between:1,50',
                'student_last_name' => 'bail|required|alpha|between:1,50',
                'dob' => 'bail|required',
                // 'cnic' => 'bail|required',
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

        $MobileDatas =  MobileDatas::find($id);

        if ($MobileDatas->delete()) {
            return redirect()->route('data.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('data.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
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
}
