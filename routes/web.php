<?php

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
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\AccountController::class, 'marks'])->name('home')->middleware('auth');
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'searchTitle'])->name('searchTitle');

    Route::get('/', [\App\Http\Controllers\VideoController::class, 'index'])->name('index');
    Route::get('/{type}/watch/{slug}', [\App\Http\Controllers\VideoController::class, 'watch'])->name('watch');
    Route::get('/country/{country}', [\App\Http\Controllers\SearchController::class, 'videosByCountry'])->name('videosByCountry');
    Route::get('/year/{year}', [\App\Http\Controllers\SearchController::class, 'videosByYear'])->name('videosByYear');
    Route::get('/{type}', [\App\Http\Controllers\SearchController::class, 'videosByType'])->name('videosByType');
    Route::get('/{type}/{genre?}', [\App\Http\Controllers\SearchController::class, 'videosByGenre'])->name('videosByGenre');



    Route::post('/addcomment', [\App\Http\Controllers\VideoController::class, 'addComment'])->name('addComment')->middleware('auth');
    Route::post('/reportcomment', [\App\Http\Controllers\VideoController::class, 'reportComment'])->name('reportComment')->middleware('auth');
    Route::post('/addmark', [\App\Http\Controllers\AccountController::class, 'addMark'])->name('addMark')->middleware('auth');
    Route::post('/deletemark', [\App\Http\Controllers\AccountController::class, 'deleteMark'])->name('deleteMark')->middleware('auth');
    Route::post('/changemark', [\App\Http\Controllers\AccountController::class, 'changeMark'])->name('changeMark')->middleware('auth');

    Route::get('/play/videofile/{id}', [\App\Http\Controllers\VideoPlayerController::class, 'play'])->name('stream');


