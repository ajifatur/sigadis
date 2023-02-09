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
    // return view('welcome');
    return redirect('auth.login');
});

Route::group(['middleware' => ['faturhelper.admin']], function() {
    // Terduga
    Route::get('/admin/kasus', 'KasusController@index')->name('admin.kasus.index');
    Route::get('/admin/kasus/create', 'KasusController@create')->name('admin.kasus.create');
    Route::post('/admin/kasus/store', 'KasusController@store')->name('admin.kasus.store');
    Route::get('/admin/kasus/detail/{id}', 'KasusController@detail')->name('admin.kasus.detail');
    Route::get('/admin/kasus/edit/{id}', 'KasusController@edit')->name('admin.kasus.edit');
    Route::post('/admin/kasus/update', 'KasusController@update')->name('admin.kasus.update');
    Route::post('/admin/kasus/delete', 'KasusController@delete')->name('admin.kasus.delete');

    // Surat Panggilan
    Route::get('/admin/kasus/{id}/surat-panggilan/create', 'SuratPanggilanController@create')->name('admin.surat-panggilan.create');
    Route::get('/admin/kasus/{id}/surat-panggilan/edit/{surat_id}', 'SuratPanggilanController@edit')->name('admin.surat-panggilan.edit');
    Route::post('/admin/surat-panggilan/store', 'SuratPanggilanController@store')->name('admin.surat-panggilan.store');
    Route::post('/admin/surat-panggilan/delete', 'SuratPanggilanController@delete')->name('admin.surat-panggilan.delete');
    Route::get('/admin/surat-panggilan/print/{id}', 'SuratPanggilanController@print')->name('admin.surat-panggilan.print');

    // Berita Acara Pemeriksaan
    Route::get('/admin/kasus/{id}/bap/create', 'BAPController@create')->name('admin.bap.create');
    Route::get('/admin/kasus/{id}/bap/edit/{bap_id}', 'BAPController@edit')->name('admin.bap.edit');
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