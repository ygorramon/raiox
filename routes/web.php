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
            Route::get('/modulos', 'Admin\ModuleController@index')->name('modules.index');
            Route::get('/modulo/{id}/submodules', 'Admin\ModuleController@submodules')->name('submodules.index');
            Route::get('/submodule/{id}/queries', 'Admin\ModuleController@queries')->name('queries.index');
            Route::get('/duvidas/atrasadas', 'Admin\ModuleController@doubtsArasadosView')->name('duvidas.atrasadas');
            Route::get('/duvidas', 'Admin\ModuleController@doubtsView')->name('duvidas.index');
            Route::get('/duvida/{id}', 'Admin\ModuleController@doubtsShow')->name('duvidas.show');
            Route::put('/duvida/{id}', 'Admin\ModuleController@doubtsResponder')->name('duvidas.responder');
            Route::get('/situacoes/respostas', 'Admin\AnswerController@respostas');

            Route::resource('/clients', 'Admin\ClientsController');
            Route::get('/clients-ativos', 'Admin\ClientsController@ativos');
            Route::any('clients/search', 'Admin\ClientsController@search')->name('clients.search');

            Route::get('/situacoes', 'Admin\AnswerController@categories')->name('situacoes.index');
            Route::get('/situacoes/{id}/respostas', 'Admin\AnswerController@index')->name('situacoes.respostas.index');
            
            Route::get('/situacoes/{id}/respostas/create', 'Admin\AnswerController@create')->name('situacoes.respostas.create');
            Route::post('/situacoes/{url}/respostas', 'Admin\AnswerController@store')->name('situacoes.respostas.store');
            Route::put('/situacoes/{id}/respostas/{answerId}', 'Admin\AnswerController@update')->name('situacoes.respostas.update');
            Route::get('/situacoes/{id}/answer/{answerId}/edit', 'Admin\AnswerController@edit')->name('situacoes.respostas.edit');

            Route::get('/Desafios/disponiveis', 'Admin\ChallengeController@availables')->name('challenge.availables');
            Route::get('/Desafios/novo_disponiveis', 'Admin\ChallengeController@new_availables')->name('challenge.new_availables');
            Route::get('/Desafios/meus', 'Admin\ChallengeController@myChallenges')->name('challenge.my');
            Route::post('/Desafios/meus/{id}/chatIniciar', 'Admin\ChallengeController@chatIniciar')->name('challenge.meus.iniciarchat');

            Route::get('/Desafios/meus/{id}', 'Admin\ChallengeController@showMyChallenge')->name('challenge.meus.show');
            Route::get('/Desafios/meus/black/{id}', 'Admin\ChallengeController@showMyChallengeBlack')->name('challenge.meus.show.black');
            Route::get('/Desafios/meus/nowindow/{id}', 'Admin\ChallengeController@showMyChallengeNoWindow')->name('challenge.meus.show.noWindow');
            Route::get('/Desafios/meus/{id}/responder', 'Admin\ChallengeController@responder')->name('challenge.meus.responder');
            Route::get('/Desafios/meus/{id}/respostas', 'Admin\ChallengeController@respostas')->name('challenge.meus.respostas');
        Route::get('/Desafios/meus/{id}/respostas2', 'Admin\ChallengeController@respostas2')->name('challenge.meus.respostas2');

            Route::put('/Desafio/disponiveis/{id}', 'Admin\ChallengeController@getChallenge')->name('challenge.get');
            Route::put('/Desafios/meus/{id}/responder', 'Admin\ChallengeController@responderUpdate')->name('challenge.meus.responder.update');
            Route::get('/Desafios/meus/{id}/chat', 'Admin\ChallengeController@chat')->name('challenge.meus.chat');
            Route::get('/Desafios/meus/{id}/chat2', 'Admin\ChallengeController@chat2')->name('challenge.meus.chat2');

            Route::post('/Desafios/meus/{id}/chat', 'Admin\ChallengeController@chatStore')->name('challenge.meus.chat.store');
            Route::get('/Desafios/meus/chat/{id}/message', 'Admin\ChallengeController@messageEdit')->name('challenge.meus.message.edit');
            Route::put('/Desafios/meus/{id}/message', 'Admin\ChallengeController@messageUpdate')->name('challenge.meus.messsage.update');

            Route::get('/Desafios/meus/chats/todos', 'Admin\ChallengeController@chats')->name('challenge.meus.chats');

            Route::get('/Desafios/meus/chats/abertos', 'Admin\ChallengeController@chatAbertos')->name('challenge.meus.chats.abertos');

            Route::get('/Desafios/disponiveis/{id}', 'Admin\ChallengeController@showAvailables')->name('challenge.availables.show');
            Route::put('/Desafio/disponiveis/{id}', 'Admin\ChallengeController@getChallenge')->name('challenge.get');
            Route::get('/relatorios', 'Admin\DashboardController@relatorios')->name('relatorios.index');
            Route::post('/relatorios/search', 'Admin\DashboardController@search')->name('relatorios.search');
            Route::get('/relatorios/Desafios-atrasados', 'Admin\DashboardController@atrasados')->name('relatorios.atrasados');
             Route::get('/relatorios/enviados', 'Admin\DashboardController@enviados')->name('relatorios.enviados');

            Route::get('/relatorios/chats-atrasados', 'Admin\DashboardController@chats')->name('relatorios.chats-atrasados');
            Route::get('/relatorios/clients', 'Admin\DashboardController@relatorioClientsIndex')->name('relatorios.clients.index');
            Route::any('/relatorios/clients/search', 'Admin\DashboardController@relatorioClientsSearch')->name('relatorios.clients.search');
            Route::get('/relatorios/clients/{id}/Desafios', 'Admin\DashboardController@relatorioClientsDesafios')->name('relatorios.clients.Desafios');
            Route::get('/relatorios/terapeutas', 'Admin\DashboardController@usersIndex')->name('relatorios.users.index');
            Route::post('/relatorios/terapeutas/search', 'Admin\DashboardController@usersSearch')->name('relatorios.users.search');

            Route::get('/relatorios/terapeuta/{id}', 'Admin\DashboardController@usersShow')->name('relatorios.users.show');
            Route::get('/relatorio/challenge/tranferir/{id}', 'Admin\DashboardController@transferirChallenge')->name('relatorios.challenge.transferir');
            Route::put('/relatorio/challenge/tranferir/{id}', 'Admin\DashboardController@transferirChallengeUpdate')->name('relatorios.challenge.transferir.update');
            //teste
        });
    Auth::routes();

});



Route::middleware('auth.client:clients')
    ->group(function () {

        Route::post('/logout', 'Auth\LoginClientController@logout')->name('clients.logout');
        Route::get('/Desafios', 'Site\ChallengeController@index')->name('Desafio.index');
        Route::get('/chat', 'Site\ChallengeController@chat')->name('chat.index');
        Route::get('/faq', 'Site\ChallengeController@doubtCenter')->name('doubtCenter.index');
        Route::get('/faq/{id}/modulo', 'Site\ChallengeController@doubtCenterModule')->name('doubtCenterModule.index');
        Route::get('/faq/modulo/{id}/submodule', 'Site\ChallengeController@doubtCenterSubmodule')->name('doubtCenterSubModule.index');
        Route::get('/perguntar', 'Site\ChallengeController@queryShow')->name('query.show');
        Route::post('/query', 'Site\ChallengeController@query')->name('query.store');
        Route::get('/perguntas', 'Site\ChallengeController@myQueries')->name('my.queries');
        Route::get('/pergunta/{id}', 'Site\ChallengeController@doubtShow')->name('my.query.show');
        Route::post('/Desafios', 'Site\ChallengeController@store')->name('Desafio.store');
        Route::get('/Desafio/{id}/', 'Site\ChallengeController@show')->name('Desafio.show');
        Route::get('/Desafio/{id}/create/{day}', 'Site\ChallengeController@analyzeCreate')->name('analyze.create');
        Route::post('/Desafio/{id}/create/{day}', 'Site\ChallengeController@analyzeStore')->name('analyze.store');
        Route::get('/Desafio/{id}/edit/{day}', 'Site\ChallengeController@analyzeEdit')->name('analyze.edit');
        Route::put('/Desafio/{id}/edit/{day}', 'Site\ChallengeController@analyzeUpdate')->name('analyze.update');

        Route::get('/Desafio/{id}/preanalise/{day}','Site\ChallengeController@passo1')->name('analyze.passo1');
        Route::get('/Desafio/{id}/passo2', 'Site\ChallengeController@passo2')->name('analyze.passo2');
        Route::get('/Desafio/{id}/passo2_analise', 'Site\ChallengeController@passo2_analise')->name('analyze.passo2_analise');
        Route::post('/Desafio/{id}/passo2', 'Site\ChallengeController@formulario_create')->name('analyze.formulario.create');
        Route::put('/Desafio/{id}/update', 'Site\ChallengeController@formulario_update')->name('analyze.formulario.update');
        Route::get('/Desafio/{id}/passo4', 'Site\ChallengeController@passo4')->name('analyze.passo4');
        Route::get('/Desafio/{id}/passo4_analise', 'Site\ChallengeController@passo4_analise')->name('analyze.passo4.analise');
        Route::get('/Desafio/{id}/conclusao', 'Site\ChallengeController@conclusao')->name('analyze.conclusao');
        Route::get('/Desafio/{id}/passo3_despertar', 'Site\ChallengeController@passo3_despertar')->name('analyze.passo3_despertar');
        Route::get('/Desafio/{id}/passo3_despertar', 'Site\ChallengeController@passo3_despertar')->name('analyze.passo3_despertar');
        Route::get('/Desafio/{id}/passo3_despertar_analise', 'Site\ChallengeController@passo3_despertar_analise')->name('analyze.passo3_despertar.analise');
        Route::get('/Desafio/{id}/passo3_rotina_sonecas', 'Site\ChallengeController@passo3_rotina_sonecas')->name('analyze.passo3_rotina_sonecas');
        Route::get('/Desafio/{id}/passo3_rotina_sonecas2', 'Site\ChallengeController@passo3_rotina_sonecas2')->name('analyze.passo3_rotina_sonecas2');
        Route::get('/Desafio/{id}/passo3_rotina_sonecas_analise', 'Site\ChallengeController@passo3_rotina_sonecas_analise')->name('analyze.passo3_rotina_sonecas.analise');
        Route::get('/Desafio/{id}/passo3_pilares', 'Site\ChallengeController@passo3_pilares')->name('analyze.passo3_pilares');
        Route::get('/Desafio/{id}/passo3_pilares_analise', 'Site\ChallengeController@passo3_pilares_analise')->name('analyze.passo3_pilares.analise');
        Route::get('/Desafio/{id}/form', 'Site\ChallengeController@analyzeCreateForm')->name('analyze.form');
        Route::post('/Desafio/{id}/form', 'Site\ChallengeController@analyzeStoreForm')->name('analyze.form.store');
        Route::get('/Desafio/{id}/form/edit', 'Site\ChallengeController@analyzeEditForm')->name('analyze.form.edit');
        Route::put('/Desafio/{id}/form/edit', 'Site\ChallengeController@analyzeUpdateForm')->name('analyze.form.update');

        Route::post('/Desafio/{id}/chat', 'Site\ChallengeController@chatStore')->name('challenge.chat.store');


        Route::put('/Desafio/{id}/', 'Site\ChallengeController@DesafioUpdate')->name('Desafio.update');
        Route::get('/profile', 'Site\ChallengeController@clientEdit')->name('client.profile.edit');
        Route::put('/profile', 'Site\ChallengeController@clientUpdate')->name('client.profile.update');

        Route::get('/edit-message/{id}/', 'Site\ChallengeController@messageEdit')->name('client.message.edit');
        Route::put('/edit-message/{id}/', 'Site\ChallengeController@messageUpdate')->name('client.message.update');


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
Route::post('/desativa_usuario', 'Admin\ClientsController@desativeUser');
Route::post('/novo_usuario_terapeuta', 'Admin\ClientsController@apiUserTerapeuta');
