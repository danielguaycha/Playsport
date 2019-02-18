<?php

//Auth::routes();
Route::get('dt-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('dt-login', 'Auth\LoginController@login');
Route::post('dt-logout', 'Auth\LoginController@logout')->name('logout');



Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', 'AdminController@index')->name('home');

    //Pages
    Route::resource('page', 'PageController');

    //Teams
    Route::resource('team', 'TeamController');

    //Players
    Route::resource('player', 'PlayerController')->except(['show', 'create']);
    Route::get('player/{team}/create', 'PlayerController@create')->name('player.create');

    //Tournament
    Route::resource('tournament', 'TournamentController');
    Route::post('tournament/{id}/process', 'TournamentController@process')->name('tournament.process');

    //Groups
    Route::resource('group', 'GroupController');
    Route::post('group/{id}/process', 'GroupController@process')->name('group.process');
    Route::post('groups/{tournamet_id}/destroy', 'GroupController@destroy_all')->name('group.destroy_all');

    //Stages
    Route::resource('stage', 'StageController');
    Route::get('stage/result/{stage}', 'StageController@result')->name('stage.result');
    Route::get('stage/change/result', 'StageController@change_result')->name('stage.change');
    Route::post('stages/{tournamet_id}/destroy', 'StageController@destroy_all')->name('stage.destroy_all');

    //TimeTable
    Route::middleware(['auth'])->group(function () {
        Route::resource('timetable', 'TimeTableController')->middleware('auth');
        Route::post('timetable/stage', 'TimeTableController@store_stage')->name('timetable.store.stage')->middleware('auth');

        //Dates - LEAGUE
        Route::get('league/{tournament_id}/create/league', 'TimeTableController@dates_league')->name('timetable.dates.league');
        Route::get('league/{group_id}/show', 'TimeTableController@show_dates_league')->name('league.show');
        Route::post('league/postponed', 'TimeTableController@postponed')->name('league.postponed');

        //Dates - GROUP
        Route::get('groups/{tournament_id}/show', 'TimeTableController@show_dates_groups')->name('dates.group.show');
    });


    //Results
    Route::get('/result/{id}/edit', 'ResultController@edit')->name('result.edit');
    Route::post('/result', 'ResultController@store_result')->name('result.store');
    Route::post('/result/stats', 'ResultController@store_stats')->name('result.store.stats');
    Route::delete('/result/stats/{id}', 'ResultController@destroy_stats')->name('result.destroy.stats');
    Route::post('/result/status/{id}', 'ResultController@update_status')->name('result.update.status');

    //Round
    Route::post('/round/update/{id}', 'RoundController@update')->name('round.update');

    //Postergaciones
    Route::post('postponed/{time_table_id}/destroy', 'PostPonedController@destroy')->name('postponed.destroy');
});







Route::redirect('futbol', 'futbol/fechas');
Route::redirect('futsal', 'futsal/fechas');
Route::redirect('basket-f', 'basket-f/fechas');
Route::redirect('basket-m', 'basket-m/fechas');
Route::redirect('volley', 'volley/fechas');



Route::namespace('Guest')->group(function (){
    Route::get('/', 'IndexController@index')->name('index');
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