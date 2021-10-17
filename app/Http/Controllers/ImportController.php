<?php

namespace App\Http\Controllers;

use App\Imports\{MembersImport, GroupsImport, StudentsImport, SectionsImport, SubjectsImport};
use App\Jobs\GroupsUploadFile;
use App\Jobs\SectionsFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\File;

class ImportController extends Controller
{
    public function ImportGroups(Request $request)
    {
        $request->validate([
            'groups_file' => 'required|mimes:csv,xls,xlsx'
        ]);
        if ($request->hasFile('groups_file')) {

            $file = $request->file('groups_file');
            $path = $file->storeAs('public/uploads', time() . '_' . $file->getClientOriginalName());

            GroupsUploadFile::dispatch(session('Data.id'), $path);

            return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'File is queued. It will be uploaded shortly.');
        } else {
            return redirect()->route('r.imports')->with('AlertType', 'warning')->with('AlertMsg', 'Please select a csv or excel file.');
        }


        // $import = new GroupsImport;
        // $import->import($request->file('groupsfile'));

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }
    }

    public function ImportSections(Request $request)
    {
        $request->validate([
            'sections_file' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($request->hasFile('sections_file')) {

            $file = $request->file('sections_file');
            $path = $file->storeAs('public/uploads', time() . '_' . $file->getClientOriginalName());

            SectionsFileUpload::dispatch(session('Data.id'), $path);

            return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'File is queued. It will be uploaded shortly.');
        } else {
            return redirect()->route('r.imports')->with('AlertType', 'warning')->with('AlertMsg', 'Please select a csv or excel file.');
        }
        // $import = new SectionsImport;
        // $import->import($request->file('sectionsfile'));

        // if ($import->failures()->isNotEmpty()) {
        //     return back()->withFailures($import->failures());
        // }

        // return redirect()->route('r.imports')->with('AlertType', 'success')->with('AlertMsg', 'Data is imported.');
    }

    public function ImportMembers(Request $request)
    {

        if (session('Data.company_nature') == 'B')
            $import = new MembersImport;
        else
            $import = new StudentsImport;

        $import->import($request->file('membersfile'));

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
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

    public function DeleteUploadedFile()
    {
        # code...
    }
}
