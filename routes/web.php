<?php

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
    return view('welcome');;
})->name('raiz');
/*Route::get('google', function () {
    return view('googleAuth');
});*/
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('callback', 'Auth\LoginController@handleGoogleCallback');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('profe');
Route::get('/eliminarinci/{id}','HomeController@eliminarInci');
Route::get('/modificarinci/{id}','HomeController@indexEdit');
Route::post('/modificarinciPost/{id}','HomeController@modificarInci');
Route::get('/crearinci','HomeController@index2')->name('crear');
Route::post('/crearinciPost','HomeController@crearInci');
Route::prefix('admin')->group(function(){
    Route::get('/home','HomeController@indexAdmin')->name('homeAdmin')->middleware('admin');
    Route::get('/modificarEstado/{id}','HomeController@indexEstado');
    Route::post('/modificarEstadoPost/{id}','HomeController@modificarEstado');
    Route::get('/hacerComentario/{id}','HomeController@indexComentario');
    Route::post('/hacerComentarioPost/{id}','HomeController@hacerComentario');
});


//Route::get('/homeadmin');
