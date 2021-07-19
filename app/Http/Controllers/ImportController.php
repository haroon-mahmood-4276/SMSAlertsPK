<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Imports\GroupsImport;
use App\Imports\StudentsImport;
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
        $import = new SectionsImport;
        $import->import($request->file('sectionsfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }

    public function ImportMembers(Request $request)
    {
        if (session('Data.company_nature') == 'B')
            $import = new MembersImport;
        else
            $import = new StudentsImport;


        $import->import($request->file('membersfile'));

        // dd($import);
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }
}
