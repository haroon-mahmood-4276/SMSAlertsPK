<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MobileDataController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
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
    // return dd(session('Data'));
    return view('sms.multiplesms');
})->name('r.multiplesmsshow');

Route::get('sms/bulk', [SmsController::class, 'BulkSMSShow'])->name('r.bulksmsshow');

Route::post('sms/quick', [SmsController::class, 'QuickSMS'])->name('r.quicksms');
Route::post('sms/multiple', [SmsController::class, 'MultipleSMS'])->name('r.multiplesms');
Route::post('sms/bulk', [SmsController::class, 'BulkSMS'])->name('r.bulksms');
Route::get('logout', [UserController::class, 'logout'])->name('r.logout');

Route::get('imports', function () {
    // return dd(session('Data'));
    return view('mobiledata.imports');
})->name('r.imports');
