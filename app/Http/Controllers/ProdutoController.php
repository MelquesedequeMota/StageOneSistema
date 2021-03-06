<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Produtos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProdutoController extends Controller
{

    public function criarProduto(Request $request){
        $cpfcnpjpessoa = $request->session()->get('cpfcnpjpessoa');
    if($request->session()->get('conf') == 1){
        $conf = 1;
        $request->session()->forget('conf');
    }else{
        $conf = 0;
    }

    $categorias = DB::connection('tenant')->table('categorias')->get();
    $produtos = DB::connection('tenant')->table('produtos')->get();
    $cores = DB::connection('tenant')->table('cores')->get();
    $tamanhos = DB::connection('tenant')->table('tamanhos')->get();
    $unidades = DB::connection('tenant')->table('unidades')->get();

    return view('cadastroproduto',
    ['conf'=>$conf,
    'produtos' => $produtos,
    'cores' => $cores,
    'tamanhos' => $tamanhos,
    'unidades' => $unidades,
    'categorias'=>$categorias
    ]);

}

    public function criarProdutoPost(Request $request){

        $conf = 0;

        $sku = '';
        $ref = '';
        $wms = '';

        $categorias = DB::connection('tenant')->table('categorias')->get();

        if($request->input('criar')){

            $imagem = $request->img;
            $nomeimagem = $request->idproduto.$request->idcor.$request->idtamanho.'.'.$imagem->getClientOriginalExtension();
            $imagem = Image::make($imagem);
            $imagem->save(public_path('imagens/').$nomeimagem);

            $produtos = new Produtos();
            $produtos->nomeproduto = $request->input('nomeproduto');
            $produtos->descproduto = $request->input('descproduto');
            $produtos->categoriaproduto = $request->input('categoriaproduto');
            $produtos->estqminproduto = $request->input('estqminproduto');
            $produtos->valatacproduto = $request->input('valatacproduto');
            $produtos->valvareproduto = $request->input('valvareproduto');
            $produtos->quantidadeatacproduto = $request->input('quantidadeatacproduto');
            $produtos->ncmcodproduto = $request->input('ncmcodproduto');
            $produtos->ncmdescproduto = $request->input('ncmdescproduto');
            $produtos->unimedproduto = $request->input('unimedproduto');
            $produtos->local = $request->local;
            $produtos->sku = $sku;
            $produtos->ean = $request->input('eancodproduto');
            $produtos->img = $nomeimagem;
            $produtos->ref = $ref;
            $produtos->wms = $wms;
            $produtos->quantidade = $request->quantidade;
            $produtos->idproduto = $request->idproduto;
            $produtos->idcor = $request->idcor;
            $produtos->idtamanho = $request->idtamanho;
            if($produtos->save()){
                $request->session()->put('conf', 1);
            }
        }
        return redirect()->route('criarproduto');
    }
}
