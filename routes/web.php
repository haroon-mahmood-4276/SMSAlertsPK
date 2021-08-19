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
    return redirect()->route('r.showlogin');
    return view('welcome');
});

Route::group(['middleware' => ['AuthRoute']], function () {
    Route::get('login', [UserController::class, 'loginform'])->name('r.showlogin');
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

    Route::prefix('sms')->group(function () {
        Route::get('quick', [SmsController::class, 'QuickSMSView'])->name('r.quick-sms-view');
        Route::get('multiple', [SmsController::class, 'MultipleSMSView'])->name('r.multiple-sms-view');
        Route::get('bulk', [SmsController::class, 'BulkSMSView'])->name('r.bulk-sms-view');
        Route::get('dues', [SmsController::class, 'DuesSMSView'])->name('r.dues-sms-view');

        Route::post('quick', [SmsController::class, 'QuickSMS'])->name('r.quicksms');
        Route::post('multiple', [SmsController::class, 'MultipleSMS'])->name('r.multiplesms');
        Route::post('bulk', [SmsController::class, 'BulkSMS'])->name('r.bulksms');
        Route::post('dues', [SmsController::class, 'DuesSMS'])->name('r.duessms');
    });

    Route::get('imports', function () {
        return view('shared.imports');
    })->name('r.imports');

    // Data Exports
    Route::group(['prefix' => 'export/xls', 'as' => 'r.xls'], function () {
        Route::get('groups', function () {
            return Excel::download(new GroupsExport, 'groups.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('groups');

        Route::get('classes', function () {
            return Excel::download(new GroupsExport, 'classes.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('classes');

        Route::get('sections', function () {
            return Excel::download(new SectionsExport, 'sections.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('sections');

        Route::get('students', function () {
            return Excel::download(new StudentsExport, 'students.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('students');

        Route::get('members', function () {
            return Excel::download(new MembersExport, 'members.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('members');

        Route::get('dues', function () {
            return Excel::download(new DuesExport, 'dues.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('dues');
    });

    Route::group(['prefix' => 'export/csv', 'as' => 'r.csv'], function () {
        Route::get('groups', function () {
            return Excel::download(new GroupsExport, 'groups.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('groups');

        Route::get('classes', function () {
            return Excel::download(new GroupsExport, 'classes.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('classes');

        Route::get('sections', function () {
            return Excel::download(new SectionsExport, 'sections.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('sections');

        Route::get('students', function () {
            return Excel::download(new StudentsExport, 'students.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('students');

        Route::get('members', function () {
            return Excel::download(new MembersExport, 'members.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('members');

        Route::get('dues', function () {
            return Excel::download(new DuesExport, 'dues.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('dues');
    });

    // Data Import
    Route::group(['prefix' => 'import', 'as' => 'r.import'], function () {
        Route::post('groups', [ImportController::class, 'ImportGroups'])->name('groups');
        Route::post('classes', [ImportController::class, 'ImportGroups'])->name('classes');
        Route::post('sections', [ImportController::class, 'ImportSections'])->name('sections');
        Route::post('students', [ImportController::class, 'ImportMembers'])->name('students');
        Route::post('members', [ImportController::class, 'ImportMembers'])->name('members');
        Route::post('dues', [SmsController::class, 'DuesSMS'])->name('dues');
    });

    Route::get('settings', [SettingController::class, 'Settings'])->name('r.settings');
    Route::post('birthday-settings', [SettingController::class, 'BirthDaySMS'])->name('r.birthdaysettings');
    Route::post('attendance-settings', [SettingController::class, 'AttendanceSMS'])->name('r.attendancesettings');
    // Route::get('test', [SettingController::class, 'Test']);

    Route::get('packages/{package}/add', [PackageController::class, 'AddPackageView'])->name('r.add-package-view');
    Route::post('packages/{package}/add', [PackageController::class, 'AddPackage'])->name('r.add-package');

    Route::prefix('reports')->group(function () {
        Route::get('todaysummery', [ReportController::class, 'TodaySummery'])->name('r.todaysummery');
        Route::get('personalizedreport', [ReportController::class, 'PersonalizedReport'])->name('r.personalizedreport');
    });

    Route::prefix('reports/pdf')->group(function () {
        Route::get('todaysummery', [ExportPDFController::class, 'TodaySummeryPDF'])->name('r.todaysummerypdf');
        Route::get('personalizedreport', [ExportPDFController::class, 'PersonalizedReportPDF'])->name('r.personalizedreportpdf');
        Route::get('birthdayreportpdf', [ExportPDFController::class, 'BirthdayAsPDF'])->name('r.birthdayreportpdf');
    });

    Route::group(['prefix' => 'api', 'as' => 'r.api'], function () {
        Route::get('group', function () {
            return view('api.group', ['company_nature' => 'group']);
        })->name('group');

        Route::get('class', function () {
            return view('api.group', ['company_nature' => 'class']);
        })->name('class');

        Route::get('section', function () {
            return view('api.section', ['company_nature' => 'section']);
        })->name('section');

        Route::get('member', function () {
            return view('api.member', ['company_nature' => 'member']);
        })->name('member');

        Route::get('student', function () {
            return view('api.student', ['company_nature' => 'student']);
        })->name('student');

        Route::get('sms', function () {
            return view('api.sms', ['company_nature' => session('Data.company_nature') == 'B' ? 'member' : 'student']);
        })->name('sms');
    });


    Route::prefix('attendance')->group(function () {
        Route::get('manual-attendance', [SmsController::class, 'ManualAttendanceView'])->name('r.manual-attendance-view');
        Route::post('manual-attendance', [SmsController::class, 'ManualAttendance'])->name('r.manual-attendance');

        Route::get('device-attendance', [SmsController::class, 'DeviceAttendanceView'])->name('r.device-attendance-view');
        Route::post('device-attendance', [SmsController::class, 'DeviceAttendance'])->name('r.device-attendance');
    });

    Route::get('logout', [UserController::class, 'logout'])->name('r.logout');
});

Route::get('test', function () {
    $AccessDatabase = session('UserSettings.attendance_database_path');

    if (!file_exists($AccessDatabase)) {
        die("No database file.");
    }

    $MSAccess = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=$AccessDatabase; Uid=; Pwd=;");
    $SqlQuery = "SELECT USERINFO.USERID, USERINFO.Badgenumber FROM USERINFO WHERE USERINFO.USERID NOT IN (SELECT CHECKINOUT.USERID FROM CHECKINOUT WHERE (CHECKTIME>=#2/6/2018 0:0:1#));";

    foreach ($MSAccess->query($SqlQuery) as $record) {
        echo $record[0] . " ----- " . $record[1]. "<br />";
    }

});
