<?php

namespace App\Http\Controllers;

use App\Models\{Group, Subject};
use App\Rules\CheckSubjectRule;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Subjects = Subject::join('groups', 'subjects.group_id', '=', 'groups.id')->select('subjects.id', 'subjects.code', 'subjects.name', 'groups.name AS group_name')->where('subjects.user_id', '=', session('Data.id'))->get();
        return view('subject.index', ['Subjects' => $Subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        return view('subject.create', ['Groups' => $Groups]);
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
            'group' => 'required',
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckSubjectRule($request->group)],
            'name' => 'bail|required|between:1,50',
        ]);

        $Subject = new Subject;
        $Subject->user_id = session('Data.id');
        $Subject->group_id = $request->group;
        $Subject->code = $request->code;
        $Subject->name = $request->name;

        if ($Subject->save()) {
            return redirect()->route('sections.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('sections.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Subject::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Groups = Group::select('id', 'name')->where('user_id', '=', session('Data.id'))->get();
        $Subject = Subject::find($id);
        return view('subject.edit', ['Groups' => $Groups, 'Subject' => $Subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'group' => 'required',
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckSubjectRule($request->group, true, $id)],
            'name' => 'bail|required|between:1,50',
        ]);

        $Subject = Subject::find($id);
        $Subject->group_id = $request->group;
        $Subject->code = $request->code;
        $Subject->name = $request->name;

        if ($Subject->save()) {
            return redirect()->route('subjects.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('subjects.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Subject = Subject::find($id);

        if ($Subject->delete()) {
            return redirect()->route('subjects.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route('subjects.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }
}
