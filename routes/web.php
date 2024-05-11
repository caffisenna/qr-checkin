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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'ensureLoggedIn'], function () {
    // チェックイン必須route

    // イベント管理
    Route::resource('events', App\Http\Controllers\EventsController::class);

    // 参加者管理
    Route::resource('participants', App\Http\Controllers\ParticipantsController::class);

    // 参加者アップロードと登録
    // Route::get('/upload', [App\Http\Controllers\ParticipantsController::class, 'showUploadForm'])->name('upload.form');
    Route::get('participants/{event_id}/upload', [App\Http\Controllers\ParticipantsController::class, 'upload_view'])->name('upload_view');
    Route::post('/upload', [App\Http\Controllers\ParticipantsController::class, 'upload'])->name('upload');

    // チェックイン
    Route::match(['get', 'post'], '/checkin', [App\Http\Controllers\EventsController::class, 'checkin'])->name('checkin');

    // 参加者export
    Route::get('/export_members', [App\Http\Controllers\EventsController::class, 'export_members'])->name('export_members');
});


// ダウンロード
Route::get('/template', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');

// 使い方
Route::get('/usage', [App\Http\Controllers\UsageController::class, 'usage'])->name('usage');
