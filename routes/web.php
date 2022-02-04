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
    Route::get('/{type}/{slug}', [\App\Http\Controllers\VideoController::class, 'watch'])->name('watch');
    Route::post('/addcomment', [\App\Http\Controllers\VideoController::class, 'addcomment'])->name('addcomment');


