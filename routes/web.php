<?php
Route::get('/register',function (){
    \Illuminate\Support\Facades\Auth::logout();
   return redirect('/login');
});

Route::get('/', function (){
    return view('public.index');
});
Route::get('/painel/{id}','acessoController@painel')->name('painel');
Route::get('/acesso','acessoController@index')->name('acesso');
Route::post('/acesso','acessoController@acessoValidar')->name('acessoValidar');
Route::get('/ficha/candidato/{id}','candidatoController@index')->name('cIndex');
Route::post('/ficha/candidato/{id}','candidatoController@store')->name('cSave');
Route::get('/ficha/filiacao/{id}','filiacaoController@index')->name('fIndex');
Route::post('/ficha/filiacao/{id}','filiacaoController@store')->name('fSave');
Route::get('/ficha/financeiro/{id}','respfinController@index')->name('finIndex');
Route::post('/ficha/financeiro/{id}','respfinController@store')->name('finSave');

Route::get('/ficha/grupofamiliar/{id}','grupoFamiliarController@index')->name('gpoIndex');
Route::post('/ficha/grupofamiliar/{id}','grupoFamiliarController@store')->name('gpoSave');
Route::get('/ficha/grupofamiliar/delete/{id}','grupoFamiliarController@destroy')->name('gpoDestroy');
Route::post('/ficha/grupofamiliar/upload/{id}','grupoFamiliarController@despesasUpload')->name('gpoDespesasUpload');
/*
Route::get('/ficha/grupofamiliar/receitas/{id}','grupoFamiliarReceitasController@index')->name('gpoRecIndex');
Route::post('/ficha/grupofamiliar/receitas/{id}','grupoFamiliarReceitasController@store')->name('gpoRecSave');
Route::get('/ficha/grupofamiliar/receitas/delete/{id}','grupoFamiliarReceitasController@destroy')->name('gpoRecDestroy');
Route::post('/ficha/grupofamiliar/receitas/upload/{id}','grupoFamiliarReceitasController@despesasUpload')->name('gpoReceitasUpload');
*/
Route::get('/ficha/compfamiliar/{id}','compFamiliarController@index')->name('compIndex');
Route::post('/ficha/compfamiliar/{id}','compFamiliarController@store')->name('compSave');
Route::get('/ficha/compfamiliar/{id}/{id_comp}','compFamiliarController@destroy')->name('compDestroy');
Route::get('/ficha/compfamiliar/{id}/upload/{id_comp}','compFamiliarController@uploadIndex')->name('uploadIndex');
Route::post('/ficha/compfamiliar/{id}/upload/{id_comp}','compFamiliarController@uploadSave')->name('uploadSave');


Route::get('/login', 'Auth\googleController@redirectToProvider')->name('login');
Route::get('/login/google/callback', 'Auth\googleController@handleProviderCallback');

Route::group(['prefix'=>'manager/','middleware' =>'auth'], function (){
Route::get('estatisticas','estatisticasController@index')->name('estatistica');
});

Route::group(['prefix'=>'manager/','middleware' =>'auth'], function (){
    Route::get('{id}', 'manager\indexController@index')->name('manager');
    Route::get('{id}/liberar', 'manager\raAutorizaController@index')->name('liberar');
    Route::post('{id}/liberar', 'manager\raAutorizaController@save')->name('salvarliberar');
    Route::get('{id}/excluir/{id_ra}', 'manager\raAutorizaController@destroy');
    Route::get('{id}/status/{id_status}', 'manager\indexController@status')->name('status');
    Route::post('{id}/search', 'manager\indexController@search')->name('search');
    Route::get('{id}/user', 'manager\userController@index')->name('user');
    Route::post('{id}/user', 'manager\userController@create');
    Route::get('{id}/candidato/{mat}', 'manager\candidatoController@index')->name('mCandidato');
    Route::post('{id}/candidato/{mat}', 'manager\candidatoController@descontoSugerido')->name('descSugCandidato');
    Route::get('{id}/candidato/{mat}/faltadoc', 'manager\candidatoController@faltaDocumento')->name('faltaDoc');
    Route::get('{id}/candidato/{mat}/indeferido', 'manager\candidatoController@descontoIndeferido')->name('indeferido');
    Route::post('{id}/candidato/{mat}/autorizado', 'manager\candidatoController@descontoAutorizado')->name('descAutCandidato');
    Route::get('{id}/relatorio/', 'manager\candidatoController@relatorio')->name('relatorio');
    Route::post('{id}/relatorio/', 'manager\candidatoController@relatorioSave')->name('relatorioGera');    
});
Route::get('/logout', 'Auth\googleController@logoutProvider')->name('logout');
/*Route::get('/logout',function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/login');
})->name('logout');
//Auth::routes();