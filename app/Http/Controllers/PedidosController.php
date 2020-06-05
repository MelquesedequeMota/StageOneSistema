<?php

namespace App\Http\Controllers;
use App\Http\Models\Pessoas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    public function consulta(Request $request){
        $pedidos = DB::connection('tenant')->table('pedidos')->get();
        $descpedidos = DB::connection('tenant')->table('descpedidos')->get();
        return view('consultapedidos',
                        ['pedidos'=> $pedidos,
                         'descpedidos' => $descpedidos
                        ]
                    );
    }

    public function attStatusProduto(Request $request){
        $produto = DB::connection('tenant')->table('descpedidos')
                    ->where('iddescpedido', $request->iddescpedido)
                    ->first();
        if($produto->statusproduto == 1){
            DB::connection('tenant')->table('descpedidos')
              ->where('iddescpedido', $request->iddescpedido)
              ->update(['statusproduto' => 0]);
              return $produto->idpedido;
        }else{
            DB::connection('tenant')->table('descpedidos')
              ->where('iddescpedido', $request->iddescpedido)
              ->update(['statusproduto' => 1]);
              return $produto->idpedido;
        }
    }

    public function attStatusPedido(Request $request){
            DB::connection('tenant')->table('pedidos')
              ->where('idpedido', $request->idpedido)
              ->update(['statuspedido' => 1]);
              return '1';
        }
    
    public function fazerPedido(){
            return view('fazerpedido');
        }
    public function finalizarPedido(Request $request){
        date_default_timezone_set('America/Sao_Paulo');

        $novopedido = DB::connection('tenant')->table('pedidos')
            ->insert(['nomepedido' => $request->session()->get('cpfcnpjpessoa'),'datapedido' => date('d/m/Y - H:i:s'), 'statuspedido' => 0 ]);

        $pedidoatual = DB::connection('tenant')->table('pedidos')->select('idpedido')->latest('idpedido')->first();

        $total = count($request->produtos);

        $checagem = 0;

        foreach($request->produtos as $produto){
            $produtoatual = DB::connection('tenant')->table('produtos')
            ->where('idproduto', $produto[6])
            ->first();
            
            $updateestoque = DB::connection('tenant')->table('produtos')
            ->where('idproduto', $produto[6])
            ->update(['quantidade' => $produtoatual->quantidade - $produto[2]]);
            
            $novopedidodesc = DB::connection('tenant')->table('descpedidos')
            ->insert(['idpedido' => $pedidoatual->idpedido, 'nomeproduto' => $produtoatual->nomeproduto, 'quantidadeproduto' => $produto[2], 'statusproduto' => 0]);

            if($updateestoque && $novopedidodesc){
                $checagem++;
            }
            
        }
        if($total == $checagem){
            return 1;
        }else{
            return 0;
        }
        }
    }
