<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Movimentacao;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    public function consultaMovimentacao(Request $request){

        if($request->input('consultainput')){
                $movimento = DB::connection('tenant')->table('movimentacoes')
                    ->where('datamovimentacao', '>=', $request->datainicio)
                    ->where('datamovimentacao', '<=', $request->datafim)
                    ->get();
        }else{
            $movimento = DB::connection('tenant')->table('movimentacoes')
                    ->get();
        }
        
        return view('consultamovimentacoes',
        [
            'movimento'=> $movimento
        ]);

    }
}
