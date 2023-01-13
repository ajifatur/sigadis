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
    // Terduga
    Route::get('/admin/terduga', 'TerdugaController@index')->name('admin.terduga.index');
    Route::get('/admin/terduga/create', 'TerdugaController@create')->name('admin.terduga.create');
    Route::post('/admin/terduga/store', 'TerdugaController@store')->name('admin.terduga.store');
    Route::get('/admin/terduga/detail/{id}', 'TerdugaController@detail')->name('admin.terduga.detail');
    Route::get('/admin/terduga/edit/{id}', 'TerdugaController@edit')->name('admin.terduga.edit');
    Route::post('/admin/terduga/update', 'TerdugaController@update')->name('admin.terduga.update');
    Route::post('/admin/terduga/delete', 'TerdugaController@delete')->name('admin.terduga.delete');

    // Surat Panggilan
    Route::get('/admin/terduga/{id}/surat-panggilan/create', 'SuratPanggilanController@create')->name('admin.surat-panggilan.create');
    Route::get('/admin/terduga/{id}/surat-panggilan/edit/{surat_id}', 'SuratPanggilanController@edit')->name('admin.surat-panggilan.edit');
    Route::post('/admin/surat-panggilan/store', 'SuratPanggilanController@store')->name('admin.surat-panggilan.store');
    Route::post('/admin/surat-panggilan/delete', 'SuratPanggilanController@delete')->name('admin.surat-panggilan.delete');
    Route::get('/admin/surat-panggilan/print/{id}', 'SuratPanggilanController@print')->name('admin.surat-panggilan.print');

    // Berita Acara Pemeriksaan
    Route::get('/admin/terduga/{id}/bap/create', 'BAPController@create')->name('admin.bap.create');
    Route::get('/admin/terduga/{id}/bap/edit/{bap_id}', 'BAPController@edit')->name('admin.bap.edit');
    Route::post('/admin/bap/store', 'BAPController@store')->name('admin.bap.store');
    Route::post('/admin/bap/delete', 'BAPController@delete')->name('admin.bap.delete');

    // Route::get('/admin/bap', 'BAPController@index')->name('admin.bap.index');
    // Route::get('/admin/bap/create', 'BAPController@create')->name('admin.bap.create');
    // Route::get('/admin/bap/detail/{id}', 'BAPController@detail')->name('admin.bap.detail');
    // Route::get('/admin/bap/edit/{id}', 'BAPController@edit')->name('admin.bap.edit');
    // Route::post('/admin/bap/update', 'BAPController@update')->name('admin.bap.update');
    Route::get('/admin/bap/print/{id}', 'BAPController@print')->name('admin.bap.print');
});

\Ajifatur\Helpers\RouteExt::auth();
\Ajifatur\Helpers\RouteExt::admin();