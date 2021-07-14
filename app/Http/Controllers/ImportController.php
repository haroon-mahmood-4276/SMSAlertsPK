<?php

namespace App\Http\Controllers;

use App\Imports\GroupsImport;
use App\Imports\SectionsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function ImportGroups(Request $request)
    {
        $import = new GroupsImport;
        $import->import($request->file('groupsfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }

    public function ImportSections(Request $request)
    {
        // return $request->input();
        $import = new SectionsImport;
        $import->import($request->file('sectionsfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }

    public function ImportMembers(Request $request)
    {

        $import = new GroupsImport;
        $import->import($request->file('membersfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }
}
