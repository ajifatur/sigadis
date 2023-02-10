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
    // Kasus
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
    Route::get('/admin/bap/print/{id}', 'BAPController@print')->name('admin.bap.print');

    // Laporan Hasil Pemeriksaan
    Route::get('/admin/kasus/{id}/lhp/create', 'LHPController@create')->name('admin.lhp.create');
    Route::get('/admin/kasus/{id}/lhp/edit/{lhp_id}', 'LHPController@edit')->name('admin.lhp.edit');
    Route::post('/admin/lhp/store', 'LHPController@store')->name('admin.lhp.store');
    Route::post('/admin/lhp/delete', 'LHPController@delete')->name('admin.lhp.delete');
    Route::get('/admin/lhp/print/{id}', 'LHPController@print')->name('admin.lhp.print');

    // Keputusan Pembebasan Tugas Sementara
    Route::get('/admin/kasus/{id}/kpts/create', 'KPTSController@create')->name('admin.kpts.create');
    Route::get('/admin/kasus/{id}/kpts/edit/{kpts_id}', 'KPTSController@edit')->name('admin.kpts.edit');
    Route::post('/admin/kpts/store', 'KPTSController@store')->name('admin.kpts.store');
    Route::post('/admin/kpts/delete', 'KPTSController@delete')->name('admin.kpts.delete');
    Route::get('/admin/kpts/print/{id}', 'KPTSController@print')->name('admin.kpts.print');

    // Keputusan Hukuman Disiplin
    Route::get('/admin/kephukdis', 'KephukdisController@index')->name('admin.kephukdis.index');
    Route::get('/admin/kasus/{id}/kephukdis/create', 'KephukdisController@create')->name('admin.kephukdis.create');
    Route::get('/admin/kasus/{id}/kephukdis/edit/{kephukdis_id}', 'KephukdisController@edit')->name('admin.kephukdis.edit');
    Route::post('/admin/kephukdis/store', 'KephukdisController@store')->name('admin.kephukdis.store');
    Route::post('/admin/kephukdis/delete', 'KephukdisController@delete')->name('admin.kephukdis.delete');
    Route::get('/admin/kephukdis/print/{id}', 'KephukdisController@print')->name('admin.kephukdis.print');

    // Surat Panggilan untuk Menerima Keputusan Hukuman Disiplin
    Route::get('/admin/kasus/{id}/spmk/create', 'SPMKController@create')->name('admin.spmk.create');
    Route::get('/admin/kasus/{id}/spmk/edit/{spmk_id}', 'SPMKController@edit')->name('admin.spmk.edit');
    Route::post('/admin/spmk/store', 'SPMKController@store')->name('admin.spmk.store');
    Route::post('/admin/spmk/delete', 'SPMKController@delete')->name('admin.spmk.delete');
    Route::get('/admin/spmk/print/{id}', 'SPMKController@print')->name('admin.spmk.print');
});

\Ajifatur\Helpers\RouteExt::auth();
\Ajifatur\Helpers\RouteExt::admin();

Route::group(['middleware' => ['faturhelper.admin']], function() {
    // Dashboard
    Route::get('/admin', function() {
        return view('admin/dashboard/index');
    })->name('admin.dashboard');
});