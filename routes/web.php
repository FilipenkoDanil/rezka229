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

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', [\App\Http\Controllers\VideoController::class, 'index'])->name('index');
    Route::get('/{type}/watch/{slug}', [\App\Http\Controllers\VideoController::class, 'watch'])->name('watch');
    Route::get('/{type}', [\App\Http\Controllers\VideoController::class, 'videosByType'])->name('videosByType');
    Route::get('/{type}/{genre}', [\App\Http\Controllers\VideoController::class, 'videosByGenre'])->name('videosByGenre');

    Route::post('/addcomment', [\App\Http\Controllers\VideoController::class, 'addComment'])->name('addComment');
    Route::post('/reportcomment', [\App\Http\Controllers\VideoController::class, 'reportComment'])->name('reportComment');

    Route::get('/play/videofile/{id}', [\App\Http\Controllers\VideoPlayerController::class, 'play'])->name('stream');

