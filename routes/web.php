<?php

use App\Exports\GroupsExport;
use App\Exports\MembersExport;
use App\Exports\SectionsExport;
use App\Exports\StudentsExport;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MobileDataController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SmsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('r.login');
    return view('welcome');
});

Route::post('login', [UserController::class, 'login'])->name('r.login');

Route::group(['middleware' => ['AuthRoute']], function () {
    Route::get('login', [UserController::class, 'loginform'])->name('r.login');
});
Route::get('dashboard', [UserController::class, 'dashboard'])->name('r.dashboard');

Route::resources([
    'users' => UserController::class,
    'groups' => GroupController::class,
    'sections' => SectionController::class,
    'data' => MobileDataController::class,
    'templates' => TemplateController::class
]);

Route::get('sections/{section}/list', [SectionController::class, 'GetSectionList'])->name('r.sectionlist');
Route::get('data/{groupid}/{sectionid}/list', [MobileDataController::class, 'STDList'])->name('r.studentlist');

Route::get('sms/history', [SmsController::class, 'index'])->name('r.smshistory');

Route::get('sms/quick', function () {
    return view('sms.quicksms');
})->name('r.quicksmsshow');

Route::get('sms/multiple', function () {
    return view('sms.multiplesms');
})->name('r.multiplesmsshow');

Route::get('sms/bulk', [SmsController::class, 'BulkSMSShow'])->name('r.bulksmsshow');

Route::post('sms/quick', [SmsController::class, 'QuickSMS'])->name('r.quicksms');
Route::post('sms/multiple', [SmsController::class, 'MultipleSMS'])->name('r.multiplesms');
Route::post('sms/bulk', [SmsController::class, 'BulkSMS'])->name('r.bulksms');
Route::get('logout', [UserController::class, 'logout'])->name('r.logout');

Route::get('imports', function () {
    return view('mobiledata.imports');
})->name('r.imports');

// Data Exports
Route::prefix('export/xls')->group(function () {
    Route::get('groups', function () {
        return Excel::download(new GroupsExport, 'groups.xls', \Maatwebsite\Excel\Excel::XLS);
    })->name('r.xlsgroups');

    Route::get('classes', function () {
        return Excel::download(new GroupsExport, 'classes.xls', \Maatwebsite\Excel\Excel::XLS);
    })->name('r.xlsclasses');

    Route::get('sections', function () {
        return Excel::download(new SectionsExport, 'sections.xls', \Maatwebsite\Excel\Excel::XLS);
    })->name('r.xlssections');

    Route::get('students', function () {
        return Excel::download(new StudentsExport, 'students.xls', \Maatwebsite\Excel\Excel::XLS);
    })->name('r.xlsstudents');

    Route::get('members', function () {
        return Excel::download(new MembersExport, 'members.xls', \Maatwebsite\Excel\Excel::XLS);
    })->name('r.xlsmembers');
});

Route::prefix('export/csv')->group(function () {
    Route::get('groups', function () {
        return Excel::download(new GroupsExport, 'groups.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    })->name('r.csvgroups');

    Route::get('classes', function () {
        return Excel::download(new GroupsExport, 'classes.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    })->name('r.csvclasses');

    Route::get('sections', function () {
        return Excel::download(new SectionsExport, 'sections.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    })->name('r.csvsections');

    Route::get('students', function () {
        return Excel::download(new StudentsExport, 'students.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    })->name('r.csvstudents');

    Route::get('members', function () {
        return Excel::download(new MembersExport, 'members.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
    })->name('r.csvmembers');
});

// Data Import
Route::prefix('import')->group(function () {

    Route::post('groups', [ImportController::class, 'ImportGroups'])->name('r.importgroups');

    Route::post('classes', [ImportController::class, 'ImportGroups'])->name('r.importclasses');

    Route::post('sections', [ImportController::class, 'ImportSections'])->name('r.importsections');

    Route::post('students', [ImportController::class, 'ImportMembers'])->name('r.importstudents');

    Route::post('members', [ImportController::class, 'ImportMembers'])->name('r.importmembers');
});

Route::get('test', function () {
    $User = User::find(1);
    dd($User->expiry_date . " - " . Date('Y-m-d') . " - " . strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date)));
});
