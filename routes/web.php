<?php

use App\Exports\DuesExport;
use App\Exports\GroupsExport;
use App\Exports\MembersExport;
use App\Exports\SectionsExport;
use App\Exports\StudentsExport;
use App\Http\Controllers\ExportPDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MobileDataController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SmsController;
use App\Models\Mobiledatas;
use Carbon\Carbon;
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

Route::group(['middleware' => ['AuthRoute']], function () {
    Route::get('login', [UserController::class, 'loginform'])->name('r.login');
    Route::post('login', [UserController::class, 'login'])->name('r.login');

    Route::get('dashboard', [UserController::class, 'dashboard'])->name('r.dashboard');

    Route::resources([
        'users' => UserController::class,
        'groups' => GroupController::class,
        'sections' => SectionController::class,
        'data' => MobileDataController::class,
        'templates' => TemplateController::class,
    ]);

    Route::get('sections/{section}/list', [SectionController::class, 'GetSectionList'])->name('r.sectionlist');
    Route::get('data/{groupid}/{sectionid}/list', [MobileDataController::class, 'STDList'])->name('r.studentlist');


    Route::get('sms/quick', [SmsController::class, 'ShowQuickSMS'])->name('r.quicksmsshow');
    Route::get('sms/multiple', [SmsController::class, 'ShowMultipleSMS'])->name('r.multiplesmsshow');
    Route::get('sms/bulk', [SmsController::class, 'BulkSMSShow'])->name('r.bulksmsshow');
    Route::get('sms/dues', [SmsController::class, 'ShowDuesSMS'])->name('r.smsdues');

    Route::post('sms/quick', [SmsController::class, 'QuickSMS'])->name('r.quicksms');
    Route::post('sms/multiple', [SmsController::class, 'MultipleSMS'])->name('r.multiplesms');
    Route::post('sms/bulk', [SmsController::class, 'BulkSMS'])->name('r.bulksms');
    Route::post('sms/dues', [SmsController::class, 'DuesSMS'])->name('r.duessms');


    Route::get('imports', function () {
        return view('shared.imports');
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

        Route::get('dues', function () {
            return Excel::download(new DuesExport, 'dues.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('r.xlsdues');
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

        Route::get('dues', function () {
            return Excel::download(new DuesExport, 'dues.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('r.csvdues');
    });

    // Data Import
    Route::prefix('import')->group(function () {
        Route::post('groups', [ImportController::class, 'ImportGroups'])->name('r.importgroups');
        Route::post('classes', [ImportController::class, 'ImportGroups'])->name('r.importclasses');
        Route::post('sections', [ImportController::class, 'ImportSections'])->name('r.importsections');
        Route::post('students', [ImportController::class, 'ImportMembers'])->name('r.importstudents');
        Route::post('members', [ImportController::class, 'ImportMembers'])->name('r.importmembers');
        Route::post('dues', [SmsController::class, 'DuesSMS'])->name('r.importdues');
    });

    Route::get('settings', [SettingController::class, 'Settings'])->name('r.settings');
    Route::post('birthdaysettings', [SettingController::class, 'BirthDaySMS'])->name('r.birthdaysettings');
    Route::post('smssettings', [SettingController::class, 'SMSSetting'])->name('r.smssettings');
    // Route::get('test', [SettingController::class, 'Test']);

    Route::get('packages/{package}/add', [PackageController::class, 'ShowAddPackage'])->name('r.showaddpackage');
    Route::post('packages/{package}/add', [PackageController::class, 'AddPackage'])->name('r.addpackage');

    Route::prefix('reports')->group(function () {
        Route::get('todaysummery', [ReportController::class, 'TodaySummery'])->name('r.todaysummery');
        Route::get('personalizedreport', [ReportController::class, 'PersonalizedReport'])->name('r.personalizedreport');
    });

    Route::prefix('reports/pdf')->group(function () {
        Route::get('todaysummery', [ExportPDFController::class, 'TodaySummeryPDF'])->name('r.todaysummerypdf');
        Route::get('personalizedreport', [ExportPDFController::class, 'PersonalizedReportPDF'])->name('r.personalizedreportpdf');
        Route::get('birthdayreportpdf', [ExportPDFController::class, 'BirthdayAsPDF'])->name('r.birthdayreportpdf');
    });

    Route::prefix('api')->group(function () {
        Route::get('group', function () {
            return view('api.group');
        })->name('r.apigroup');

        Route::get('class', function () {
            return view('api.group');
        })->name('r.apiclass');
    });


    Route::get('logout', [UserController::class, 'logout'])->name('r.logout');
});
