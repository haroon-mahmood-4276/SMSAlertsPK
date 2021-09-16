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
        $Templates = Template::where('user_id', '=', session('Data.id'))->get();
        // return $Template;
        return view('template.index', ['Templates' => $Templates]);
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
            return redirect()->route('templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been saved.');
        } else {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not saved.');
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
        return Template::find($id);
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
        $Templates->name = $request->name;
        $Templates->template = $request->template;

        if ($Templates->save()) {
            return redirect()->route('templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been updated.');
        } else {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not updated.');
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
            return redirect()->route('templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Template has been deleted.');
        } else {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Template could not deleted.');
        }
    }

    public function deleteAll(Request $request)
    {
        // return $request->template_ids;
        $AlertType = "";
        $AlertMsg = "";
        try {
            if ($request->template_ids != null) {
                Template::whereIn('id', $request->template_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            if ($ex->getCode() == 23000) {
                $AlertType = "danger";
                $AlertMsg = "These selected sections linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('templates.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }
}
