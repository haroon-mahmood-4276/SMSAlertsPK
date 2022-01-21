<?php

use App\Exports\{
    DuesExport,
    GroupsExport,
    MembersExport,
    SectionsExport,
    StudentsExport,
    SubjectsExport
};
use App\Http\Controllers\{
    AjaxController,
    ExportPDFController,
    UserController,
    GroupController,
    ImportController,
    MobileDataController,
    SettingController,
    PackageController,
    ReportController,
    SectionController,
    TemplateController,
    SmsController,
    SubjectController,
    TeacherController
};
use App\Models\{Group};
use Illuminate\Http\{Request};
use Illuminate\Support\{Carbon};
use Illuminate\Support\Facades\{Route, Validator};
use Maatwebsite\Excel\Facades\{Excel};

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
    return view('welcome');
})->name('r.welcome');

Route::group(['middleware' => ['AuthRoute']], function () {
    Route::get('login', [UserController::class, 'loginform'])->name('r.showlogin');
    Route::post('login', [UserController::class, 'login'])->name('r.login');

    Route::get('dashboard', [UserController::class, 'dashboard'])->name('r.dashboard');

    Route::group(['prefix' => 'delete-all', 'as' => 'r.delete-all-'], function () {
        Route::get('groups', [GroupController::class, 'deleteAll'])->name('groups');
        Route::get('classes', [GroupController::class, 'deleteAll'])->name('classes');
        Route::get('sections', [SectionController::class, 'deleteAll'])->name('sections');
        Route::get('members', [MobileDataController::class, 'deleteAll'])->name('members');
        Route::get('students', [MobileDataController::class, 'deleteAll'])->name('students');
        Route::get('subjects', [SubjectController::class, 'deleteAll'])->name('subjects');
        Route::get('teachers', [TeacherController::class, 'deleteAll'])->name('teachers');
        Route::get('templates', [TemplateController::class, 'deleteAll'])->name('templates');
    });

    Route::get('check/groups', [GroupController::class, 'CheckGroupCodeExistance'])->name('r.check-group-code');
    Route::get('check/classes', [GroupController::class, 'CheckGroupCodeExistance'])->name('r.check-class-code');
    Route::get('check/data', [MobileDataController::class, 'CheckMobileDataCodeExistance'])->name('r.check-data-code');

    Route::resources([
        'users' => UserController::class,
        'groups' => GroupController::class,
        'classes' => GroupController::class,
        'sections' => SectionController::class,
        'data' => MobileDataController::class,
        'templates' => TemplateController::class,
        'subjects' => SubjectController::class,
        'teachers' => TeacherController::class,
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

        Route::get('subjects', function () {
            return Excel::download(new SubjectsExport, 'subjects.xls', \Maatwebsite\Excel\Excel::XLS);
        })->name('subjects');
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

        Route::get('subjects', function () {
            return Excel::download(new SubjectsExport, 'subjects.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
        })->name('subjects');
    });

    // Data Import
    Route::group(['prefix' => 'import', 'as' => 'r.import'], function () {
        Route::post('groups', [ImportController::class, 'ImportGroups'])->name('groups');
        Route::post('classes', [ImportController::class, 'ImportGroups'])->name('classes');
        Route::post('sections', [ImportController::class, 'ImportSections'])->name('sections');
        Route::post('students', [ImportController::class, 'ImportMembers'])->name('students');
        Route::post('members', [ImportController::class, 'ImportMembers'])->name('members');
        Route::post('dues', [SmsController::class, 'DuesSMS'])->name('dues');
        Route::post('subjects', [ImportController::class, 'ImportSubjects'])->name('subjects');
    });

    Route::get('settings', [SettingController::class, 'Settings'])->name('r.settings');
    Route::group(['prefix' => 'settings', 'as' => 'r.settings-'], function () {
        Route::post('birthday', [SettingController::class, 'BirthDaySMS'])->name('birthday');
        Route::post('attendance', [SettingController::class, 'AttendanceSMS'])->name('attendance');
        Route::post('geo-location', [SettingController::class, 'GeoLocation'])->name('geo-location');
    });


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

    Route::prefix('ajax')->group(function () {
        Route::get('sections-against-subject/{id}', [AjaxController::class, 'SectionsAgainstSubject'])->name('r.sections-against-subject');
        Route::get('students-against-subject/{subject_id}/sections/{id}', [AjaxController::class, 'StudentsAgainstSubject'])->name('r.students-against-subject');
        Route::get('students-assigned-to-subject/{id}', [AjaxController::class, 'StudentsAssignedToSubject'])->name('r.students-assigned-to-subject');
    });

    Route::get('teacher-attendance', [TeacherController::class, 'TeacherAttendanceView'])->name('r.teacher-attendance-view');
    Route::post('teacher-attendance', [TeacherController::class, 'TeacherAttendance'])->name('r.teacher-attendance');


    Route::get('logout', [UserController::class, 'logout'])->name('r.logout');
});
