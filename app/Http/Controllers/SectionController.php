<?php

namespace App\Http\Controllers;

use App\Models\{Group, Section};
use App\Rules\CheckSectionCode;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Sections = Section::join('groups', 'sections.group_id', '=', 'groups.id')->select('sections.id', 'sections.code', 'sections.name', 'groups.name AS group_name')->groupBy('group_name', 'sections.code')->where('sections.user_id', '=', session('Data.id'))->paginate(50);
        return view('section.index', ['Sections' => $Sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        return view('section.create', ['Groups' => $Groups]);
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
            'class' => 'required',
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckSectionCode($request->code)],
            'name' => 'bail|required|between:1,50',
        ]);

        $Sections = new Section;
        $Sections->user_id = session('Data.id');
        $Sections->code = $request->code;
        $Sections->group_id = $request->group_name;
        $Sections->name = $request->name;

        if ($Sections->save()) {
            return redirect()->route('sections.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('sections.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
        return Section::find($id);
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
        $Sections = Section::find($id);
        return view('section.edit', ['Groups' => $Groups, 'Section' => $Sections]);
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
            'class' => 'required',
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckSectionCode($request->group_name, true, $id)],
            'name' => 'bail|required|between:1,50',
        ]);

        $Sections = Section::find($id);
        // return $Sections;
        $Sections->code = $request->code;
        $Sections->group_id = $request->group_name;
        $Sections->name = $request->name;

        if ($Sections->save()) {
            return redirect()->route('sections.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('sections.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
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
        $AlertType = "";
        $AlertMsg = "";
        try {
            if ($request->section_ids != null) {
                Section::whereIn('id', $request->section_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000 || $ex->getCode() == 42000) {
                $AlertType = "warning";
                $AlertMsg = "These selected sections linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('sections.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }

    public function deleteAll()
    {
        try {
            Section::where('user_id', session('Data.id'))->delete();
            $AlertType = "success";
            $AlertMsg = "Data deleted";
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000 || $ex->getCode() == 42000) {
                $AlertType = "warning";
                $AlertMsg = "These selected sections linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('sections.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }

    public function GetSectionList($id)
    {
        return Section::where('group_id', '=', $id)->get();
    }
}
