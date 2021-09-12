<?php

namespace App\Http\Controllers;

use App\Imports\{MembersImport, GroupsImport, StudentsImport, SectionsImport, SubjectsImport};
use Illuminate\Http\Request;

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
        try {
            if (session('Data.company_nature') == 'B')
                $import = new MembersImport;
            else
                $import = new StudentsImport;

            $import->import($request->file('membersfile'));

            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
        } catch (\Illuminate\Database\QueryException $th) {
            return redirect()->route('r.imports')->with('AlertType', 'danger')->with('AlertMsg', $th);
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }

    public function ImportSubjects(Request $request)
    {
        $import = new SubjectsImport;
        $import->import($request->file('subjectsfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }
}
