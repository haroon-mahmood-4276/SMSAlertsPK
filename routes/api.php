<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\SectionController;

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

Route::name('api.')->group(
    function () {
        Route::apiResources([
            'groups' => GroupController::class,
            'classes' => GroupController::class,
        ]);

        // Section Routes
        Route::name('sections.')->prefix('/classes/{class_code}')->group(function () {
            Route::get('sections', [SectionController::class, 'index'])->name('index');
            Route::get('sections/{code}', [SectionController::class, 'show'])->name('show');

            Route::post('sections', [SectionController::class, 'store'])->name('store');
            Route::put('sections/{code}', [SectionController::class, 'update'])->name('update');
            Route::delete('sections/{code}', [SectionController::class, 'destroy'])->name('destroy');
        });

        // MobileData Routes
        Route::name('data.')->prefix('/classes/{class_code}/sections/{section_code}')->group(function () {
            // Section Routes
            Route::get('data', [MobileDataController::class, 'index'])->name('index');
            Route::get('data/{code}', [MobileDataController::class, 'show'])->name('show');

            Route::post('data', [MobileDataController::class, 'store'])->name('store');
            Route::put('data/{code}', [MobileDataController::class, 'update'])->name('update');
            Route::delete('data/{code}', [MobileDataController::class, 'destroy'])->name('destroy');
        });
    }
);
