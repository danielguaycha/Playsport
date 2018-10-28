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

Route::prefix('admin')->namespace('Admin')->group(function () {

    // teams
    Route::resource('team', 'TeamController');

    // players
    Route::resource('player', 'PlayerController')->except(['show', 'create']);
    Route::get('player/{team}/create', 'PlayerController@create')->name('player.create');

    //Tournament
    Route::resource('tournament', 'TournamentController')->only(['index', 'create', 'store', 'edit', 'update']);
});



// Groups

Route::get('/dash/g/', 'Admin\GroupController@index')->name('group.index');
Route::get('/dash/g/create', 'Admin\GroupController@create')->name('group.create');
Route::post('/dash/g/', 'Admin\GroupController@store')->name('group.store');
Route::get('/dash/g/{id}/destroy/', 'Admin\GroupController@destroy')->name('group.destroy');

//Stages
Route::get('/dash/st/create', 'Admin\StageController@create')->name('stage.create');
Route::post('/dash/st/', 'Admin\StageController@store')->name('stage.store');

Route::get('/register', function (){
   abort(404);
});


//TimeTables
Route::get('/dash/tt/create', 'Admin\TimeTableController@create')->name('timetable.create');
Route::post('/dash/tt/', 'Admin\TimeTableController@store')->name('timetable.store');
Route::get('/dash/tt/del/{id}', 'Admin\TimeTableController@destroy')->name('timetable.destroy');



