<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    public function criarPessoa(Request $request){

        $conf = 0;
        if($request->input('cpfcnpj') != ''){

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

        return view('cadastropessoa',['conf'=>$conf]);
    }
}
        
        