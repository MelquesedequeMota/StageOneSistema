<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    public function criarPessoa(Request $request){

        $conf = 0;
        $criar = 0;
        $mensagemerro = "";

        if($request->input('cpfcnpj') != ''){

        $cpf = preg_replace("/[^0-9]/", "", $request->input('cpfcnpj'));

        $link = mysqli_connect('localhost', 'root', '');
        if (!$link) {
            $conf = 2;
        }

        $sql = 'CREATE DATABASE IF NOT EXISTS c'. $cpf;
        if (mysqli_query($link, $sql)) {
            mysqli_select_db($link, 'c'.$cpf);
            $criartabelas = 'CREATE TABLE caixas (
                idcaixa bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                estadocaixa int(11) NOT NULL,
                PRIMARY KEY (idcaixa)
              );
              
              CREATE TABLE categorias (
                idcategoria int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
                nomecategoria varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idcategoria)
              );
              
              CREATE TABLE cores (
                idcor int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
                nomecor varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idcor)
              );
              
              CREATE TABLE lotes (
                idlote bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                numerolote int(11) NOT NULL,
                idproduto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                quantidadelote int(11) NOT NULL,
                destinolote int(11) NOT NULL,
                PRIMARY KEY (idlote)
              );
              
              CREATE TABLE movimentacoes (
                idmovimentacao int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
                idproduto int(11) NOT NULL,
                datamovimentacao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                usuariomovimentacao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                lotemovimentacao tinyint(4) NOT NULL,
                obsmovimentacao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                nomeunidademovimentacao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idmovimentacao)
              );
              
              CREATE TABLE produtos (
                idproduto int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
                nomeproduto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                descproduto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                categoriaproduto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                sku varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                ean varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                img varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                ref varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                wms varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                estqminproduto tinyint(4) NOT NULL,
                quantidade bigint(20) NOT NULL,
                valatacproduto double(5,2) DEFAULT NULL,
                valvareproduto double(5,2) NOT NULL,
                quantidadeatacproduto tinyint(4) NOT NULL,
                ncmcodproduto varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                ncmdescproduto varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                unimedproduto varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                local varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                idcor int(11) DEFAULT NULL,
                idtamanho int(11) DEFAULT NULL,
                PRIMARY KEY (idproduto)
              );
              
              CREATE TABLE tamanhos (
                idtamanho int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
                nometamanho varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idtamanho)
              );
              
              CREATE TABLE unidades (
                idunidade int(2) unsigned zerofill NOT NULL AUTO_INCREMENT,
                cpfcnpjunidade varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                nomeunidade varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idunidade)
              );
              
              CREATE TABLE vendaobs (
                idvendaobs bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                idvenda int(11) NOT NULL,
                idprodutovenda int(11) NOT NULL,
                quantidadevenda int(11) NOT NULL,
                PRIMARY KEY (idvendaobs)
              );
              
              CREATE TABLE vendas (
                idvenda int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
                caixavenda int(11) NOT NULL,
                metodopagamento varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                datavenda varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (idvenda)
              )';
              if(mysqli_query($link, $criartabelas)){
                $inserirbasico = "INSERT INTO cores VALUES (01,'Vermelho'),(02,'Azul'),(03,'Violeta'),(04,'Verde'),(05,'Amarelo'),(06,'Branco'),(07,'Preto'),(08,'Rosa'),(09,'Laranja');
                INSERT INTO categorias VALUES (01,'Informatica'),(02,'Telefones e Celulares'),(03,'Vestimentas e Acessorios'),(04,'Alimentacao'),(05,'Medicamento'),(06,'Eletronicos');
                INSERT INTO tamanhos VALUES (01,'PP'),(02,'P'),(03,'M'),(04,'G'),(05,'GG'),(06,'XG');
                ";
                if(mysqli_query($link, $inserirbasico)){
                    $criar = 1;
                }else{
                    $mensagemerro = "Erro na Inserções do Banco: " . mysqli_error($link);
                }
              }else{
                dd(mysqli_error($link));
              }
        } else {
            $mensagemerro = "Erro na Criação do Banco: " . mysqli_error($link);
        }
    }

        if($criar == 1 && $mensagemerro == ''){

            $pessoa = new Pessoa();

            $pessoa->nomepessoa = $request->input('nomepessoa');
            $pessoa->cpfcnpjpessoa = preg_replace("/[^0-9]/", "", $request->input('cpfcnpj'));
            $pessoa->ceppessoa = preg_replace("/[^0-9]/", "", $request->input('ceppessoa'));
            $pessoa->emailpessoa = $request->input('emailpessoa');
            $pessoa->enderecopessoa = $request->input('enderecopessoa');
            $pessoa->fonepessoa = preg_replace("/[^0-9]/", "", $request->input('fonepessoa'));
            $pessoa->fone2pessoa = preg_replace("/[^0-9]/", "", $request->input('fone2pessoa'));
            $pessoa->fone3pessoa = preg_replace("/[^0-9]/", "", $request->input('fone3pessoa'));
            $pessoa->fone4pessoa = preg_replace("/[^0-9]/", "", $request->input('fone4pessoa'));
            $pessoa->obspessoa = $request->input('obspessoa');
            $pessoa->tipoconta = '0';
            $pessoa->permissaoconta = 'ADMIN';
            $pessoa->senhapessoa = $request->input('senhapessoa');

            if($pessoa->save()){
                $conf = 1;
            }
        }

        return view('cadastropessoa',['conf'=>$conf, 'mensagemerro' => $mensagemerro]);
    }

    public function login(Request $request){
        $conf = 0;
        if($request->input('cpfcnpjpessoa')){
            $pessoalogin = DB::table('pessoas')
            ->where('cpfcnpjpessoa', preg_replace("/[^0-9]/", "", $request->input('cpfcnpjpessoa')))
            ->where('senhapessoa', $request->input('senhapessoa'))
            ->first();
            if($pessoalogin != null){
                $request->session()->put('cpfcnpjpessoa', $request->input('cpfcnpjpessoa'));
                $request->session()->put('nomepessoa', $pessoalogin->nomepessoa);
                return redirect('index');
            }else{
                $conf = 2;
            }
        }
        return view('login', [
            'conf' => $conf,
        ]);
    }
}
        
        