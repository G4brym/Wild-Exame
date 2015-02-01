<?php
//CloudFlare Proxys
Request::setTrustedProxies(array(
    '199.27.128.0/21',
    '173.245.48.0/20',
    '103.21.244.0/22',
    '103.22.200.0/22',
    '103.31.4.0/22',
    '141.101.64.0/18',
    '108.162.192.0/18',
    '190.93.240.0/20',
    '188.114.96.0/20',
    '197.234.240.0/22',
    '198.41.128.0/17',
    '162.158.0.0/15',
    '104.16.0.0/12',
));

//Pagina De Erro
App::missing(function($exception)
{
    $title="Shoot2Kill";
    return View::make('login.404')->with('title', $title);
});

//metodos post publicos
Route::post('login', array('before'=>'csrf', 'as' => 'login', 'uses'=>'LoginController@postLogin'));
Route::post('register', array('before'=>'csrf', 'as' => 'register', 'uses'=>'LoginController@postRegister'));
Route::post('forgot', array('before'=>'csrf', 'as' => 'forgot', 'uses'=>'LoginController@postForgot'));
Route::post('activate', array('before'=>'csrf', 'as' => 'forgot', 'uses'=>'LoginController@postActivate'));

//Paginas Publicas
Route::get('/login', 'LoginController@showLogin');

//interface, têm de fazer login antes de entrar
Route::group(array('before' => 'auth'), function()
{
    //Painel de controlo
    Route::get('/exams', 'PanelController@showExams');
    Route::get('/calendar', 'PanelController@showCalendar');

    //Utilizador
    Route::get('logout', 'LoginController@logout');

    //Metodos Post
    Route::post('changePW', array('before'=>'csrf', 'as' => 'changePW', 'uses'=>'HomeController@changePW'));
    Route::post('tkcreate', array('before'=>'csrf', 'as' => 'tkcreate', 'uses'=>'PanelController@postTkCreate'));
    Route::post('tkmessage', array('before'=>'csrf', 'as' => 'tkmessage', 'uses'=>'PanelController@postTkMessage'));
});

//interface, têm de fazer login antes de entrar, sem menssagem
Route::group(array('before' => 'authWM'), function()
{
    Route::get('/', 'PanelController@showIndex');
});

//Tem de ser admin para poder executar
Route::group(array('before' => 'admin'), function()
{
    Route::get('/admin', 'PanelController@showAdmin');
	Route::get('/admin/gen', 'PanelController@genToken');
	Route::get('/admin/remove', 'PanelController@removeDate');
    Route::post('importTP', array('before'=>'csrf', 'as' => 'importTP', 'uses'=>'PanelController@importFromTProfessor'));
    Route::post('saveSettings', array('before'=>'csrf', 'as' => 'saveSettings', 'uses'=>'PanelController@saveSettings'));
    Route::post('addEspecialDate', array('before'=>'csrf', 'as' => 'addEspecialDate', 'uses'=>'PanelController@addEspecialDate'));
    Route::post('importEmails', array('before'=>'csrf', 'as' => 'importEmails', 'uses'=>'PanelController@importEmails'));
});

//Verifica se a API está ativada
Route::group(array('before' => 'apiStatus'), function()
{
	Route::get('/api', 'PanelController@showAPI');
});