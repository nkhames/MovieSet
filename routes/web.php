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
Route::post('/create','LocInsertCtrl@insert')->name('create');
Route::get('insert','LocInsertCtrl@insertform');


Route::get('api/tags', 'Api\TagsController@index');

// crud annonces 
Route::get('proposer','AnnonceCtrl@getform');
Route::post('/insert','AnnonceCtrl@insert')->name('insert');
Route::get('mesannonces','AnnonceCtrl@myAnnonce')->name('mesannonces');
Route::get('delete/{id}','AnnonceCtrl@destroy')->name('delete');
Route::post('/update','AnnonceCtrl@update')->name('update');
Route::get('modifier/{id}','AnnonceCtrl@modify')->name('modifier');

Route::get('/annonces','SearchLieu@all')->name('annonces');
Route::post('/research','SearchLieu@search')->name('research');
Route::get('setdispo','DispoCtrl@getform');


Auth::routes();

Route::get('/test', 'MapController@drawMarkers')->defaults('chemin', false)->name('test');

Route::get('/test2', 'MapController@drawMarkers')->defaults('chemin', true)->name('test2');

Route::get('/MapLieux', 'MapController@drawPublic')->defaults('chemin', false)->name('MapLieux');

Route::get('/PriseDeVues', 'Pokedex@pokedex')->name('PriseDeVues');

Route::post('/addphot','addphoto@add')->name('addphot');


Route::get('/CreateTruc', function () {
    return view('testslider');
});

Route::get('/Contact', function () {
    return view('contact');
});

Route::get('/AboutUs', function () {
    return view('About_us');
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
