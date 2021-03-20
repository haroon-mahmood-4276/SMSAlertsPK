<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\User;
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
        $Sections = Section::select('id', 'name');
        $Sections = $Sections->addSelect(['group_name' => Group::select('name')->whereColumn('id', '=', 'sections.group_id')])->orderBy('group_name')->get();
        //return $Sections;
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
            'group_name' => 'required',
            'name' => 'bail|required|between:1,50',
        ]);

        $Sections = new Section;
        $Sections->user_id = session('Data.id');
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
            'group_name' => 'required',
            'name' => 'bail|required|between:1,50',
        ]);

        $Sections = Section::find($id);
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
    public function destroy($id)
    {
        $Sections = Section::find($id);

        if ($Sections->delete()) {
            return redirect()->route('sections.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('sections.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }
}
