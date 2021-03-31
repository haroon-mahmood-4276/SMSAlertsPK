<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Template = Template::where('user_id', '=', '1')->get();
        // return $Template;
        return view('template.index', ['Templates' => $Template]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.create');
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
            'template' => 'bail|required|between:1,255',
        ]);

        $Templates = new Template;
        $Templates->user_id = session('Data.id');
        $Templates->name = $request->name;
        $Templates->template = $request->template;


        if ($Templates->save()) {
            return redirect()->route('Templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been saved.');
        } else {
            return redirect()->route('Templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not saved.');
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
        $Templates = Template::find($id);
        return view('template.edit', ['Template' => $Templates]);
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
            'template' => 'bail|required|between:1,255',
        ]);

        $Templates = Template::find($id);
        $Templates->user_id = session('Data.id');
        $Templates->name = $request->name;
        $Templates->template = $request->template;

        if ($Templates->save()) {
            return redirect()->route('Templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been updated.');
        } else {
            return redirect()->route('Templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not updated.');
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
        $Templates = Template::find($id);
        if ($Templates->delete()) {
            return redirect()->route('Templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been deleted.');
        } else {
            return redirect()->route('Templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not deleted.');
        }
    }
}
