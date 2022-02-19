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


    Route::get('/play/videofile/{id}', [\App\Http\Controllers\VideoPlayerController::class, 'play'])->name('stream');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', [App\Http\Controllers\AccountController::class, 'marks'])->name('home')->middleware('auth');
        Route::post('/addcomment', [\App\Http\Controllers\VideoController::class, 'addComment'])->name('addComment');
        Route::post('/reportcomment', [\App\Http\Controllers\VideoController::class, 'reportComment'])->name('reportComment');
        Route::post('/addmark', [\App\Http\Controllers\AccountController::class, 'addMark'])->name('addMark');
        Route::post('/deletemark', [\App\Http\Controllers\AccountController::class, 'deleteMark'])->name('deleteMark');
        Route::post('/changemark', [\App\Http\Controllers\AccountController::class, 'changeMark'])->name('changeMark');
    });

    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');
        Route::resource('video', \App\Http\Controllers\Admin\VideoController::class);
        Route::get('/add-episode/{video_id}', [\App\Http\Controllers\Admin\VideoController::class, 'addEpisode'])->name('addEpisode');
        Route::post('/store-episode', [\App\Http\Controllers\Admin\VideoController::class, 'storeEpisode'])->name('storeEpisode');
        Route::post('/upload-videofile', [\App\Http\Controllers\Admin\VideoController::class, 'upload'])->name('upload-video');
        Route::get('/reports', [\App\Http\Controllers\Admin\ReportsController::class, 'index'])->name('reports');
        Route::delete('/reports/delete-comment/{comment_id}', [\App\Http\Controllers\Admin\ReportsController::class, 'deleteComment'])->name('deleteComment');
        Route::post('/reports/report-cheked/', [\App\Http\Controllers\Admin\ReportsController::class, 'isOk'])->name('report-checked');
    });


    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'searchTitle'])->name('searchTitle');

    Route::get('/', [\App\Http\Controllers\VideoController::class, 'index'])->name('index');
    Route::get('/{type}/watch/{slug}', [\App\Http\Controllers\VideoController::class, 'watch'])->name('watch');
    Route::get('/country/{country}', [\App\Http\Controllers\SearchController::class, 'videosByCountry'])->name('videosByCountry');
    Route::get('/year/{year}', [\App\Http\Controllers\SearchController::class, 'videosByYear'])->name('videosByYear');
    Route::get('/{type}', [\App\Http\Controllers\SearchController::class, 'videosByType'])->name('videosByType');
    Route::get('/{type}/{genre?}', [\App\Http\Controllers\SearchController::class, 'videosByGenre'])->name('videosByGenre');




