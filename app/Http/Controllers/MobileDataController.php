<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\Mobiledatas;
use App\Rules\CheckMemberCode;
use Illuminate\Http\Request;

class MobileDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MobileDatas = Mobiledatas::select('id', 'code',  'student_first_name', 'student_last_name', 'student_mobile_1', 'student_mobile_2', 'DOB', 'CNIC', 'Gender', 'parent_first_name', 'parent_last_name', 'parent_mobile_1', 'parent_mobile_2')->where('user_id', '=', session('Data.id'));
        $MobileDatas = $MobileDatas->addSelect(['group_name' => Group::select('name')->whereColumn('id', '=', 'mobiledatas.group_id')]);
        $MobileDatas = $MobileDatas->addSelect(['section_name' => Section::select('name')->whereColumn('id', '=', 'mobiledatas.section_id')])->orderBy('section_name')->get();
        // return $MobileDatas;

        // $MobileDatas = Mobiledatas::join('groups', 'mobiledatas.group_id', '=', 'groups.id')->join('sections', 'mobiledatas.section_id', '=', 'sections.id')->select('mobiledatas.*', 'groups.name AS group_name', 'sections.name AS section_name')->where('user_id', '=', session('Data.id'))->get();
        // return $MobileDatas;

        return view('mobiledata.index', ['MobileDatas' => $MobileDatas]);
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
        $request->validate([
            'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode($request->group, $request->section)],
            'student_first_name' => 'bail|required|alpha|between:1,50',
            'student_last_name' => 'bail|required|alpha|between:1,50',
            'student_mobile_1' => 'bail|required|numeric|digits:12',
            'student_mobile_2' => 'bail|numeric|digits:12',
            'DOB' => 'bail|required',
            'CNIC' => 'bail|required',
            'gender' => 'required',
            'parent_first_name' => 'bail|required|alpha|between:1,50',
            'parent_last_name' => 'bail|required|alpha|between:1,50',
            'parent_mobile_1' => 'required|digits:12',
            'parent_mobile_2' => 'nullable|digits:12',
            'group' => 'required',
            'section' => 'required',
        ]);

        //dd($request->input());
        $MobileDatas = new MobileDatas;
        $MobileDatas->code = $request->code;
        $MobileDatas->student_first_name = $request->student_first_name;
        $MobileDatas->student_last_name = $request->student_last_name;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;
        $MobileDatas->DOB = $request->DOB;
        $MobileDatas->CNIC = $request->CNIC;
        $MobileDatas->Gender = $request->gender;
        $MobileDatas->parent_first_name = $request->parent_first_name;
        $MobileDatas->parent_last_name = $request->parent_last_name;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->user_id = session('Data.id');
        $MobileDatas->group_id = $request->group;
        $MobileDatas->section_id = $request->section;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        $Sections = Section::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        $MobileDatas = MobileDatas::find($id);
        return view('mobiledata.edit', ['Groups' => $Groups, 'Sections' => $Sections, 'MobileData' => $MobileDatas]);
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
        $request->validate([
            'code' => ['bail', 'required', 'alpha_num', 'between:1,20', new CheckMemberCode($request->group, $request->section, true, $id)],
            'student_first_name' => 'bail|required|alpha|between:1,50',
            'student_last_name' => 'bail|required|alpha|between:1,50',
            'student_mobile_1' => 'bail|required|numeric|digits:12',
            'student_mobile_2' => 'bail|numeric|digits:12',
            'DOB' => 'bail|required',
            'CNIC' => 'bail|required',
            'gender' => 'required',
            'parent_first_name' => 'bail|required|alpha|between:1,50',
            'parent_last_name' => 'bail|required|alpha|between:1,50',
            'parent_mobile_1' => 'required|digits:12',
            'parent_mobile_2' => 'nullable|digits:12',
            'group' => 'required',
            'section' => 'required',
        ]);

        $MobileDatas =  MobileDatas::find($id);
        $MobileDatas->roll_no = $request->roll_no;
        $MobileDatas->student_first_name = $request->student_first_name;
        $MobileDatas->student_last_name = $request->student_last_name;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;
        $MobileDatas->DOB = $request->DOB;
        $MobileDatas->CNIC = $request->CNIC;
        $MobileDatas->Gender = $request->gender;
        $MobileDatas->parent_first_name = $request->parent_first_name;
        $MobileDatas->parent_last_name = $request->parent_last_name;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->group_id = $request->group;
        $MobileDatas->section_id = $request->section;

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
}
