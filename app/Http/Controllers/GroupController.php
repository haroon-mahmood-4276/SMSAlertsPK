<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Groups = Group::select('id', 'name');
        $Groups = $Groups->addSelect(['company_name' => User::select('company_name')->whereColumn('id', '=', 'groups.user_id')])->orderBy('company_name')->get();

        // $Groups= Group::find(1)->user;
        // return $Groups;
        return view('group.index', ['Groups' => $Groups]);
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
        $request->validate([
            'name' => 'bail|required|between:1,50',
        ]);

        $Groups = new Group;
        $Groups->user_id = session('Data.id');
        $Groups->name = $request->name;

        if ($Groups->save()) {
            return redirect()->route('groups.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('groups.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Groups = Group::find($id);
        return view('group.edit', ['Group' => $Groups]);
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
            'name' => 'bail|required|between:1,50',
        ]);

        $Groups = Group::find($id);
        $Groups->name = $request->name;

        if ($Groups->save()) {
            return redirect()->route('groups.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('groups.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
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
        $Groups = Group::find($id);

        if ($Groups->delete()) {
            return redirect()->route('groups.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleteed.');
        } else {
            return redirect()->route('groups.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleteed.');
        }
    }
}