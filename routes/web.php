<?php
Route::prefix('admin')
->namespace('Admin')
->middleware('auth')
->group(function() {

    Route::get('/home', function () {
        return view('welcome');
    });

});

Route::prefix('admin')->group(function() {
    Route::middleware('auth')
    ->group(function() {
        Route::resource('/clients', 'Admin\ClientsController' );
        Route::any('clients/search', 'Admin\ClientsController@search')->name('clients.search');
    });
    Auth::routes();
   
});



Route::
middleware('auth.client:clients')
->group(function() {

    Route::post('/logout', 'Auth\LoginClientController@logout' )->name('clients.logout');
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
    Route::put('/desafio/{id}/', 'Site\ChallengeController@desafioUpdate')->name('desafio.update');





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

