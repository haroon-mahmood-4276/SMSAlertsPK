<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\MobileDatas;
use App\Models\User;
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
        $MobileDatas = MobileDatas::select('id', 'first_name', 'last_name', 'parent_mobile_1', 'parent_mobile_2', 'student_mobile_1', 'student_mobile_2');
        $MobileDatas = $MobileDatas->addSelect(['company_name' => MobileDatas::select('company_name')->whereColumn('id', '=', 'mobiledatas.user_id')]);
        $MobileDatas = $MobileDatas->addSelect(['group_name' => Group::select('name')->whereColumn('id', '=', 'mobiledatas.group_id')]);
        $MobileDatas = $MobileDatas->addSelect(['section_name' => Section::select('name')->whereColumn('id', '=', 'mobiledatas.section_id')])->orderBy('section_name')->get();
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
        $Companies = User::select('id', 'company_name')->get();
        $Groups = Group::select('id', 'name')->get();
        $Sections = Section::select('id', 'name')->get();
        return view('mobiledata.create', ['Companies' => $Companies, 'Groups' => $Groups, 'Sections' => $Sections]);
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
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'company_name' => 'required',
            'group_name' => 'required',
            'section_name' => 'required',
            'parent_mobile_1' => 'required|digits:12',
            'parent_mobile_2' => 'nullable||digits:12',
            'student_mobile_1' => 'required|digits:12',
            'student_mobile_2' => 'nullable||digits:12',
        ]);

        $MobileDatas = new MobileDatas;
        $MobileDatas->first_name = $request->first_name;
        $MobileDatas->last_name = $request->last_name;
        $MobileDatas->company_name = $request->company_name;
        $MobileDatas->group_name = $request->group_name;
        $MobileDatas->section_name = $request->section_name;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;

        if ($MobileDatas->save()) {
            return redirect()->route('mobiledata.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('mobiledata.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
        $Companies = User::select('id', 'company_name')->get();
        $Groups = Group::select('id', 'name')->get();
        $Sections = Section::select('id', 'name')->get();
        $MobileDatas = MobileDatas::find($id);
        return view('mobiledata.edit', ['Companies' => $Companies, 'Groups' => $Groups, 'Section' => $Sections, 'MobileData' => $MobileDatas]);
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
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'company_name' => 'required',
            'group_name' => 'required',
            'section_name' => 'required',
            'parent_mobile_1' => 'required|digits:12',
            'parent_mobile_2' => 'nullable||digits:12',
            'student_mobile_1' => 'required|digits:12',
            'student_mobile_2' => 'nullable||digits:12',
        ]);

        $MobileDatas =  MobileDatas::find($id);
        $MobileDatas->first_name = $request->first_name;
        $MobileDatas->last_name = $request->last_name;
        $MobileDatas->company_name = $request->company_name;
        $MobileDatas->group_name = $request->group_name;
        $MobileDatas->section_name = $request->section_name;
        $MobileDatas->parent_mobile_1 = $request->parent_mobile_1;
        $MobileDatas->parent_mobile_2 = $request->parent_mobile_2;
        $MobileDatas->student_mobile_1 = $request->student_mobile_1;
        $MobileDatas->student_mobile_2 = $request->student_mobile_2;

        if ($MobileDatas->save()) {
            return redirect()->route('mobiledata.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('mobiledata.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
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
            return redirect()->route('mobiledata.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('mobiledata.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }
}
