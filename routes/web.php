<?php
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/home', function () {
            return view('welcome');
        });
    });

Route::prefix('admin')->group(function () {
    Route::middleware('auth')
        ->group(function () {
            Route::resource('/clients', 'Admin\ClientsController');
            Route::any('clients/search', 'Admin\ClientsController@search')->name('clients.search');

            Route::get('/situacoes', 'Admin\AnswerController@categories')->name('situacoes.index');
            Route::get('/situacoes/{id}/respostas', 'Admin\AnswerController@index')->name('situacoes.respostas.index');
            Route::get('/situacoes/{id}/respostas/create', 'Admin\AnswerController@create')->name('situacoes.respostas.create');
            Route::post('/situacoes/{url}/respostas', 'Admin\AnswerController@store')->name('situacoes.respostas.store');
            Route::put('/situacoes/{id}/respostas/{answerId}', 'Admin\AnswerController@update')->name('situacoes.respostas.update');
            Route::get('/situacoes/{id}/answer/{answerId}/edit', 'Admin\AnswerController@edit')->name('situacoes.respostas.edit');

            Route::get('/desafios/disponiveis', 'Admin\ChallengeController@availables')->name('challenge.availables');
            Route::get('/desafios/meus', 'Admin\ChallengeController@myChallenges')->name('challenge.my');
            Route::get('/desafios/meus/{id}', 'Admin\ChallengeController@showMyChallenge')->name('challenge.meus.show');
            Route::get('/desafios/meus/black/{id}', 'Admin\ChallengeController@showMyChallengeBlack')->name('challenge.meus.show.black');
            Route::get('/desafios/meus/nowindow/{id}', 'Admin\ChallengeController@showMyChallengeNoWindow')->name('challenge.meus.show.noWindow');
            Route::get('/desafios/meus/{id}/responder', 'Admin\ChallengeController@responder')->name('challenge.meus.responder');
            Route::get('/desafios/meus/{id}/respostas', 'Admin\ChallengeController@respostas')->name('challenge.meus.respostas');
            Route::put('/desafio/disponiveis/{id}', 'Admin\ChallengeController@getChallenge')->name('challenge.get');
            Route::put('/desafios/meus/{id}/responder', 'Admin\ChallengeController@responderUpdate')->name('challenge.meus.responder.update');
            Route::get('/desafios/meus/{id}/chat', 'Admin\ChallengeController@chat')->name('challenge.meus.chat');
            Route::post('/desafios/meus/{id}/chat', 'Admin\ChallengeController@chatStore')->name('challenge.meus.chat.store');
            Route::get('/desafios/meus/chats/todos', 'Admin\ChallengeController@chats')->name('challenge.meus.chats');

            Route::get('/desafios/meus/chats/abertos', 'Admin\ChallengeController@chatAbertos')->name('challenge.meus.chats.abertos');
        Route::get('/desafios/meus/chatsss/abertos', 'Admin\ChallengeController@chatAbertos')->name('challenge.meus.chats.abertos');

            Route::get('/desafios/disponiveis/{id}', 'Admin\ChallengeController@showAvailables')->name('challenge.availables.show');
            Route::put('/desafio/disponiveis/{id}', 'Admin\ChallengeController@getChallenge')->name('challenge.get');
            Route::get('/relatorios', 'Admin\DashboardController@relatorios')->name('relatorios.index');
            Route::post('/relatorios/search', 'Admin\DashboardController@search')->name('relatorios.search');
            Route::get('/relatorios/desafios-atrasados', 'Admin\DashboardController@atrasados')->name('relatorios.atrasados');
            Route::get('/relatorios/chats-atrasados', 'Admin\DashboardController@chats')->name('relatorios.chats-atrasados');

        });
    Auth::routes();
});



Route::middleware('auth.client:clients')
    ->group(function () {

        Route::post('/logout', 'Auth\LoginClientController@logout')->name('clients.logout');
        Route::get('/desafios', 'Site\ChallengeController@index')->name('desafio.index');
        Route::get('/chat', 'Site\ChallengeController@chat')->name('chat.index');

        Route::post('/desafios', 'Site\ChallengeController@store')->name('desafio.store');
        Route::get('/desafio/{id}/', 'Site\ChallengeController@show')->name('desafio.show');
        Route::get('/desafio/{id}/create/{day}', 'Site\ChallengeController@analyzeCreate')->name('analyze.create');
        Route::post('/desafio/{id}/create/{day}', 'Site\ChallengeController@analyzeStore')->name('analyze.store');
        Route::get('/desafio/{id}/edit/{day}', 'Site\ChallengeController@analyzeEdit')->name('analyze.edit');
        Route::put('/desafio/{id}/edit/{day}', 'Site\ChallengeController@analyzeUpdate')->name('analyze.update');

        Route::get('/desafio/{id}/form', 'Site\ChallengeController@analyzeCreateForm')->name('analyze.form');
        Route::post('/desafio/{id}/form', 'Site\ChallengeController@analyzeStoreForm')->name('analyze.form.store');
        Route::get('/desafio/{id}/form/edit', 'Site\ChallengeController@analyzeEditForm')->name('analyze.form.edit');
        Route::put('/desafio/{id}/form/edit', 'Site\ChallengeController@analyzeUpdateForm')->name('analyze.form.update');

        Route::post('/desafio/{id}/chat', 'Site\ChallengeController@chatStore')->name('challenge.chat.store');


        Route::put('/desafio/{id}/', 'Site\ChallengeController@desafioUpdate')->name('desafio.update');
        Route::get('/profile', 'Site\ChallengeController@clientEdit')->name('client.profile.edit');
        Route::put('/profile', 'Site\ChallengeController@clientUpdate')->name('client.profile.update');

    });
Route::get('/login', 'Auth\LoginClientController@showClientLoginForm');
Route::get('/cadastro', 'Auth\RegisterClientController@showClientRegisterForm')->name('clientes.register');
Route::get('/password/reset', 'Auth\ForgotPasswordClientController@showLinkRequestClientForm')->name('clientes.reset');
Route::post('/cadastro', 'Auth\RegisterClientController@createClient')->name('clients.register');
Route::post('/login', 'Auth\LoginClientController@clientLogin')->name('clients.login');
Route::post('/password/email', 'Auth\ForgotPasswordClientController@sendResetLinkEmail')->name('clients.password.email');
Route::get('client/reset/{token}', 'Auth\ResetPasswordClientController@showResetForm');
Route::post('client/reset', 'Auth\ResetPasswordClientController@reset');



Route::get('/', function () {
    return redirect('/login');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::post('/novo_usuario', 'Admin\ClientsController@apiUser');
