<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Rules\CheckGroupCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\Debugbar\Facade as Debugbar;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Groups = Group::where('user_id', '=', session('Data.id'))->orderBy('code')->paginate(20);
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
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode()],
            'name' => 'bail|required|between:1,50',
        ]);

        $Groups = new Group;
        $Groups->user_id = session('Data.id');
        $Groups->code = $request->code;
        $Groups->name = $request->name;

        if ($Groups->save()) {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckGroupCode(true, $id)],
            'name' => 'bail|required|between:1,50',
        ]);

        $Groups = Group::find($id);
        $Groups->code = $request->code;
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
    public function destroy($id)
    {
        $Groups = Group::find($id);

        if ($Groups->delete()) {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }

    public function deleteAll(Request $request)
    {
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
            if ($ex->getCode() == 23000) {
                $AlertType = "danger";
                $AlertMsg = "These selected " . (session('Data.company_nature') == 'B' ? 'groups' : 'classes') . " linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route((session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index'))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }
}
