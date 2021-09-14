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

        if (session('Data.company_nature') == 'B')
            $import = new MembersImport;
        else
            $import = new StudentsImport;
// dd($import);
        $import->import($request->file('membersfile'));

        dd($import);



        // try {
        //     $import->import($request->file('membersfile'));
        // } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //     $failures = $e->failures();
        //     dd($failures);
        //     // foreach ($failures as $failure) {
        //     //     $failure->row(); // row that went wrong
        //     //     $failure->attribute(); // either heading key (if using heading row concern) or column index
        //     //     $failure->errors(); // Actual error messages from Laravel validator
        //     //     $failure->values(); // The values of the row that has failed.
        //     // }
        // }
        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        // return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
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
