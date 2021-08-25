<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    GroupController,
    MemberController,
    StudentController,
    SectionController,
    SmsController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::name('api.')->group(function () {

    Route::apiResources([
        'groups' => GroupController::class,
        'classes' => GroupController::class,
    ]);

    // Section Routes
    Route::name('sections.')->prefix('/classes/{class}')->group(function () {
        Route::get('sections', [SectionController::class, 'index'])->name('index');
        Route::get('sections/{code}', [SectionController::class, 'show'])->name('show');

        Route::post('sections', [SectionController::class, 'store'])->name('store');
        Route::put('sections/{code}', [SectionController::class, 'update'])->name('update');
        Route::delete('sections/{code}', [SectionController::class, 'destroy'])->name('destroy');
    });

    // MobileData Routes
    Route::name('students.')->prefix('/classes/{class}/sections/{section}')->group(function () {
        // Section Routes
        Route::get('data', [StudentController::class, 'index'])->name('index');
        Route::get('data/{code}', [StudentController::class, 'show'])->name('show');

        Route::post('data', [StudentController::class, 'store'])->name('store');
        Route::put('data/{code}', [StudentController::class, 'update'])->name('update');
        Route::delete('data/{code}', [StudentController::class, 'destroy'])->name('destroy');
    });

    // MobileData Routes
    Route::name('members.')->prefix('/groups/{group}')->group(function () {
        // Section Routes
        Route::get('data', [MemberController::class, 'index'])->name('index');
        Route::get('data/{code}', [MemberController::class, 'show'])->name('show');

        Route::post('data', [MemberController::class, 'store'])->name('store');
        Route::put('data/{code}', [MemberController::class, 'update'])->name('update');
        Route::delete('data/{code}', [MemberController::class, 'destroy'])->name('destroy');
    });

    Route::name('sms.')->prefix('sms')->group(function () {
        Route::get('quick', [SmsController::class, 'QuickSMS'])->name('quick');
    });
});
