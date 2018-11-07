<?php

Route::get('/', function () {
    return view('guest.home.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->group(function () {

    //Pages
    Route::resource('page', 'PageController');

    //Teams
    Route::resource('team', 'TeamController');

    //Players
    Route::resource('player', 'PlayerController')->except(['show', 'create']);
    Route::get('player/{team}/create', 'PlayerController@create')->name('player.create');

    //Tournament
    Route::resource('tournament', 'TournamentController')->only(['index', 'create', 'store', 'edit', 'update']);

    //Groups
    Route::resource('group', 'GroupController');

    //Stages
    Route::resource('stage', 'StageController');

    //TimeTable
    Route::resource('timetable', 'TimeTableController');
});


Route::redirect('futbol', 'torneo/1/fechas');
Route::redirect('futsal', 'torneo/2/fechas');


Route::namespace('Guest')->group(function (){
    // paginas
    //Route::post('/page', "PageController@store");
    // torneos
    Route::get('/torneo/{id}/grupos', 'TorneoController@show_groups')->name('torneo.grupos');
    Route::get('/torneo/{id}/top', 'TorneoController@show_top')->name('torneo.stats');
    Route::get('/torneo/{id}/fechas', 'TorneoController@show_times')->name('torneo.times');
    Route::get('/torneo/{id}/{page}', 'TorneoController@show_page')->name('torneo.page');

    Route::get('/{title}', 'PageController@show_page');
});

/*Route::get('/dash/g/', 'Admin\GroupController@index')->name('group.index');
Route::get('/dash/g/create', 'Admin\GroupController@create')->name('group.create');
Route::post('/dash/g/', 'Admin\GroupController@store')->name('group.store');
Route::get('/dash/g/{id}/destroy/', 'Admin\GroupController@destroy')->name('group.destroy');
Route::get('/dash/st/create', 'Admin\StageController@create')->name('stage.create');
Route::post('/dash/st/', 'Admin\StageController@store')->name('stage.store');
Route::get('/register', function (){
    abort(404);
});
Route::get('/dash/tt/create', 'Admin\TimeTableController@create')->name('timetable.create');
Route::post('/dash/tt/', 'Admin\TimeTableController@store')->name('timetable.store');
Route::get('/dash/tt/del/{id}', 'Admin\TimeTableController@destroy')->name('timetable.destroy');*/