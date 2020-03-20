<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDVController extends Controller
{

    public function adicionarItemPDV(Request $request){
        $produto = DB::connection('tenant')->table('produtos')
        ->where('ean', $request->codigo)
        ->first();
        return json_encode($produto);
    }

    public function pesquisarProdutoPDV(Request $request){
        $produtop =array(array());
        $cont = 0;
        $produtos = DB::connection('tenant')->table('produtos')
        ->where('nomeproduto', 'like', '%'.$request->nomeproduto.'%')
        ->get();
        foreach($produtos as $produtos){
            $produtop[$cont][0] = $produtos->ean;
            $produtop[$cont][1] = $produtos->nomeproduto;
            $produtop[$cont][2] = 1;
            $produtop[$cont][3] = $produtos->valvareproduto;
            $produtop[$cont][4] = $produtos->valatacproduto;
            $produtop[$cont][5] = $produtos->quantidadeatacproduto;
            $produtop[$cont][6] = $produtos->idproduto;
            $produtop[$cont][7] = $produtos->quantidade;
            $cont++;
        }
        return $produtop;
    }

    public function finalizarCompraPDV(Request $request){
        
        date_default_timezone_set('America/Sao_Paulo');

        $resultado = [];

        switch($request->metodopagamento){
            case 1:
                $metodopagamento = 'Dinheiro';
            break;
            
            case 2:
                $metodopagamento = 'Cartão de Débito';
            break;

            case 3:
                $metodopagamento = 'Crédito Á Vista';
            break;

            case 4:
                $metodopagamento = 'Crédito Parcelado';
            break;
        }

        $novavenda = DB::connection('tenant')->table('vendas')
            ->insert(['caixavenda' => 1, 'metodopagamento' => $metodopagamento, 'datavenda' => date('d/m/Y - H:i:s')]);

        $vendaatual = DB::connection('tenant')->table('vendas')->select('idvenda')->latest('idvenda')->first();

        $total = count($request->produtos);

        $checagem = 0;

        foreach($request->produtos as $produto){
            $produtoatual = DB::connection('tenant')->table('produtos')
            ->where('idproduto', $produto[0])
            ->first();

            $updateestoque = DB::connection('tenant')->table('produtos')
            ->where('idproduto', $produto[0])
            ->update(['quantidade' => $produtoatual->quantidade - $produto[2]]);
            
            $novovendaobs = DB::connection('tenant')->table('vendaobs')
            ->insert(['idvenda' => $vendaatual->idvenda, 'idprodutovenda' => $produto[0], 'quantidadevenda' => $produto[2]]);

            if($updateestoque && $novovendaobs){
                $checagem++;
            }
            
        }
        if($total == $checagem){
            return 1;
        }else{
            return 0;
        }
    }

    public function abrirCaixa(){
        $caixaatual = DB::connection('tenant')->table('caixas')->where('idcaixa', '1')->first();
        if($caixaatual->estadocaixa == 1){
            return view('pdv');
        }else{
            $caixaatual = DB::connection('tenant')->table('caixas')->where('idcaixa', '1')->update(['estadocaixa' => 1]);
            return view('pdv');
        }
    }

    public function fecharCaixa(){
        $fecharcaixa = DB::connection('tenant')->table('caixas')->where('idcaixa', '1')->update(['estadocaixa' => 0]);
        if($fecharcaixa){
            return redirect('montarlote');
        }
    }
}
