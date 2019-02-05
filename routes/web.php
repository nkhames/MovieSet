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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/test', function () {
    return view('base');
});
Route::post('/create','LocInsertCtrl@insert')->name('create');;
Route::get('insert','LocInsertCtrl@insertform');

Auth::routes();

Route::get('/test', 'MapController@drawMarkers')->defaults('chemin', false)->name('test');

Route::get('/test2', 'MapController@drawMarkers')->defaults('chemin', true)->name('test2');

Route::get('/PriseDeVues', 'Pokedex@pokedex')->name('PriseDeVues');

Route::get('/CreateTruc', function () {
    return view('testslider');
});

Route::get('/hashtag',function(){
    return view('hashtag');
});

Route::get('api/tags', 'Api\TagsController@index');

/*Route::get('/test', function () {
    $config['center']= '48.8534, 2.3488';
    $config['zoom']= '10';
    $config['map_height']='500px';
    $config['scrollwheel']=false;
    GMaps::initialize($config);
    $marker['position'] = '48.8534, 2.3488';
    $marker['infowindow_content']='<h2>Je mange du pain</h2>';
    GMaps::add_marker($marker);
    $map = GMaps::create_map();



    return view('base')->with('map', $map);
});*/
