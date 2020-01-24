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

Route::get('criarproduto', 'ProdutoController@criarProduto')->name('criarproduto');
Route::post('criarproduto/post', 'ProdutoController@criarProdutoPost')->name('criarproduto.post');

Route::get('adicionarestoque', 'EstoqueController@adicionarEstoque')->name('adicionarestoque');

Route::get('retirarestoque', 'EstoqueController@retirarEstoque')->name('retirarestoque');

Route::get('criarpessoa', 'PessoaController@criarPessoa')->name('criarpessoa');

Route::get('montarlote', 'EstoqueController@montarLote')->name('montarlote');

Route::get('retiradalote', 'EstoqueController@retiradaLote')->name('retiradalote');

Route::get('pdv', 'PDVController@abrirCaixa')->name('abrircaixa');

Route::get('fecharcaixa', 'PDVController@fecharCaixa')->name('fecharcaixa');

Route::get('buscaritem', 'PDVController@buscarItemPDV')->name('buscaritem');

Route::get('buscarcpfcnpj', 'PessoaController@buscarCPFCNPJ')->name('buscarcpfcnpj');

Route::get('testeread', 'PessoaController@testeread')->name('testeread');

Route::get('finalizarcompra', 'PDVController@finalizarCompraPDV')->name('finalizarcompra');

Route::get('receberlote/{numerolote}', 'EstoqueController@receberLote')->name('receberlote');

Route::get('consultaestoque', 'EstoqueController@consultaEstoque')->name('consultaestoque');

Route::get('consultamovimentacoes', 'MovimentacaoController@consultaMovimentacao')->name('consultamovimentacoes');

Route::get('index', 'Index@Index')->name('index');

Route::get('login', 'PessoaController@login')->name('login');

Route::get('/', function(){
    phpinfo();
});

