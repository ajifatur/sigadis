<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/simpeg', function() {
    $simpeg = file_get_contents("https://simpeg.unnes.ac.id/index.php/gen_xml/list_doskar_by_key/10/1");
    $simpeg = json_decode($simpeg, true);
    return response()->json($simpeg, 200);
})->name('api.simpeg');

\Ajifatur\Helpers\RouteExt::api();