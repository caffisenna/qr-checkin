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


// ダウンロード
Route::get('/download', [App\Http\Controllers\DownloadController::class, 'download'])->name('download');
