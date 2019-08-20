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

Route::get('/', 'UsuarioController@retornaLogin');
Route::get('/login','UsuarioController@index');
Route::post('/login','UsuarioController@logar');
Route::get('/logout','UsuarioController@logout');
//PARTE USUARIO COMUM
Route::get('/home','UsuarioController@retornarUsuario')->middleware('restricao','restricaousuario');
Route::get('/novochamado','UsuarioController@retornaNovoChamado')->middleware('restricao','restricaousuario');
Route::post('/novochamado','UsuarioController@registrarChamado')->middleware('restricao','restricaousuario');
Route::get('/historico','UsuarioController@trazerChamados')->middleware('restricao','restricaousuario');

//PARTE ADM
Route::get('/adm','UsuarioController@retornarAdm')->middleware('restricao','restricaoadm');
Route::get('/cadastrofuncionario','UsuarioController@cadastroFuncionario')->middleware('restricao','restricaoadm');
Route::post('/cadastrarfuncionario','UsuarioController@cadastrarFuncionario')->middleware('restricao','restricaoadm');
Route::get('/funcionarios', 'UsuarioController@listarFuncionarios')->middleware('restricao','restricaoadm');
Route::get('/funcionario/editar/{id}', 'UsuarioController@editFuncionario')->middleware('restricao','restricaoadm');
Route::post('/funcionario/{id}', 'UsuarioController@atualizaFuncionario')->middleware('restricao','restricaoadm');
Route::get('/perfil-adm','UsuarioController@irPerfil')->middleware('restricao','restricaoadm');
Route::post('/editarperfil','UsuarioController@atualizarPerfil')->middleware('restricao','restricaoadm');
