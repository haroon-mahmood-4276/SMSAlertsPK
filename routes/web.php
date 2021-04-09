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
Route::get('sms', [SmsController::class, 'index'])->name('r.sms');
Route::get('logout', [UserController::class, 'logout'])->name('r.logout');
