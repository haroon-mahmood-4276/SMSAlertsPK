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
        Route::get('/classes/{class_code}/sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/classes/{class_code}/sections/{code}', [SectionController::class, 'show'])->name('sections.show');

        Route::post('/classes/{class_code}/sections', [SectionController::class, 'store'])->name('sections.store');
        Route::put('/classes/{class_code}/sections/{code}', [SectionController::class, 'update'])->name('sections.update');
        Route::delete('/classes/{class_code}/sections/{code}', [SectionController::class, 'destroy'])->name('sections.destroy');

        // MobileData Routes
    }
);
