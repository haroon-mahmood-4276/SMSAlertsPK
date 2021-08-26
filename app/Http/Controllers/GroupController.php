<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Rules\CheckGroupCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\Debugbar\Facade as Debugbar;


class GroupController extends Controller
{
    private $comapny_nature;

    public function __construct()
    {
        $this->comapny_nature = Str::of(session('Data.company_nature') == 'B' ? 'group' : 'class')->plural();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Debugbar::info('asdadasdas');
        $Groups = Group::where('user_id', '=', session('Data.id'))->orderBy('code')->get();
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
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
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
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
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
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleted.');
        } else {
            return redirect()->route($this->comapny_nature . '.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleted.');
        }
    }
}
