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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Videos
    Route::get('/video', [App\Http\Controllers\VideoController::class, 'index'])->name('show-form');
    Route::post('/subir-video', [App\Http\Controllers\VideoController::class, 'saveVideo'])->name('upload');
    Route::get('/image/{image}', [App\Http\Controllers\VideoController::class, 'imageShow'])->name('show-image');
    Route::get('/ver-video/{id}', [App\Http\Controllers\VideoController::class, 'showVideo'])->name('show-video');
    Route::get('/video/{video}', [App\Http\Controllers\VideoController::class, 'getVideo'])->name('get-video');
    Route::get('/video/edit/{video}', [App\Http\Controllers\VideoController::class, 'getVideoEdit'])->name('edit-video');
    Route::put('/video/edit/{video}', [App\Http\Controllers\VideoController::class, 'update'])->name('update');
    Route::delete('/video/{video}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('destroy-video');

    // Buscador
    Route::get('/buscar', [App\Http\Controllers\VideoController::class, 'search'])->name('search');

    // Comments
    Route::post('/comentar', [App\Http\Controllers\CommentsController::class, 'store'])->name('comment');
    Route::delete('/comentar/{id}', [App\Http\Controllers\CommentsController::class, 'destroy'])->name('destroy');


    // Cahnnel
    Route::get('/canal/{id}', [App\Http\Controllers\ChannelController::class, 'channel'])->name('channel');

});
