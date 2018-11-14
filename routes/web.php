<?php

Route::get('/', function () {
    return view('guest.home.index');
});

//Auth::routes();
Route::get('dt-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('dt-login', 'Auth\LoginController@login');
Route::post('dt-logout', 'Auth\LoginController@logout')->name('logout');

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
    Route::get('stage/result/{stage}', 'StageController@result')->name('stage.result');
    Route::get('stage/change/result', 'StageController@change_result')->name('stage.change');

    //TimeTable
    Route::resource('timetable', 'TimeTableController');
    Route::post('timetable/stage', 'TimeTableController@store_stage')->name('timetable.store.stage');

    //Results
    Route::get('/result/{id}/edit', 'ResultController@edit')->name('result.edit');
    Route::post('/result', 'ResultController@store_result')->name('result.store');
    Route::post('/result/stats', 'ResultController@store_stats')->name('result.store.stats');
    Route::delete('/result/stats/{id}', 'ResultController@destroy_stats')->name('result.destroy.stats');
    Route::post('/result/status/{id}', 'ResultController@update_status')->name('result.update.status');
});


Route::redirect('futbol', 'futbol/fechas');
Route::redirect('futsal', 'futsal/fechas');
Route::redirect('basket-f', 'basket-f/fechas');
Route::redirect('basket-m', 'basket-m/fechas');
Route::redirect('volley', 'volley/fechas');


Route::namespace('Guest')->group(function (){
    // paginas
    //Route::post('/page', "PageController@store");
    // torneos
    Route::get('{url}/resultados', 'TorneoController@show_groups')->name('torneo.grupos');
    Route::get('{url}/stats', 'TorneoController@show_top')->name('torneo.stats');
    Route::get('{url}/fechas', 'TorneoController@show_times')->name('torneo.times');
    Route::get('{url}/final', 'TorneoController@show_stage')->name('torneo.final');
    Route::get('{url}/{page}', 'TorneoController@show_page')->name('torneo.page');

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