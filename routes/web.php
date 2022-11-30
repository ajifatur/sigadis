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

Route::group(['middleware' => ['faturhelper.admin']], function() {
    // Surat Panggilan
    Route::get('/admin/surat-panggilan', 'SuratPanggilanController@index')->name('admin.surat-panggilan.index');
    Route::get('/admin/surat-panggilan/create', 'SuratPanggilanController@create')->name('admin.surat-panggilan.create');
    Route::post('/admin/surat-panggilan/store', 'SuratPanggilanController@store')->name('admin.surat-panggilan.store');
    Route::get('/admin/surat-panggilan/detail/{id}', 'SuratPanggilanController@detail')->name('admin.surat-panggilan.detail');
    Route::get('/admin/surat-panggilan/edit/{id}', 'SuratPanggilanController@edit')->name('admin.surat-panggilan.edit');
    Route::post('/admin/surat-panggilan/update', 'SuratPanggilanController@update')->name('admin.surat-panggilan.update');
    Route::post('/admin/surat-panggilan/delete', 'SuratPanggilanController@delete')->name('admin.surat-panggilan.delete');
    Route::get('/admin/surat-panggilan/print/{id}', 'SuratPanggilanController@print')->name('admin.surat-panggilan.print');

    // Berita Acara Pemeriksaan
    Route::get('/admin/berita-acara-pemeriksaan', 'BeritaAcaraPemeriksaanController@index')->name('admin.berita-acara-pemeriksaan.index');
    Route::get('/admin/berita-acara-pemeriksaan/create', 'BeritaAcaraPemeriksaanController@create')->name('admin.berita-acara-pemeriksaan.create');
    Route::post('/admin/berita-acara-pemeriksaan/store', 'BeritaAcaraPemeriksaanController@store')->name('admin.berita-acara-pemeriksaan.store');
    Route::get('/admin/berita-acara-pemeriksaan/detail/{id}', 'BeritaAcaraPemeriksaanController@detail')->name('admin.berita-acara-pemeriksaan.detail');
    Route::get('/admin/berita-acara-pemeriksaan/edit/{id}', 'BeritaAcaraPemeriksaanController@edit')->name('admin.berita-acara-pemeriksaan.edit');
    Route::post('/admin/berita-acara-pemeriksaan/update', 'BeritaAcaraPemeriksaanController@update')->name('admin.berita-acara-pemeriksaan.update');
    Route::post('/admin/berita-acara-pemeriksaan/delete', 'BeritaAcaraPemeriksaanController@delete')->name('admin.berita-acara-pemeriksaan.delete');
    Route::get('/admin/berita-acara-pemeriksaan/print/{id}', 'BeritaAcaraPemeriksaanController@print')->name('admin.berita-acara-pemeriksaan.print');
});

\Ajifatur\Helpers\RouteExt::auth();
\Ajifatur\Helpers\RouteExt::admin();