<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function Index(){
        return view('index');
    }

    public function enviarSugestao(Request $request){
        $salvarsugestao = DB::table('sugestaos')
        ->insert(['sugestao' => $request->sugestao]);

        if($salvarsugestao){
            return 'Sugestão enviada com sucesso!';
        }else{
            return 'Erro no envio da sugestão, tente novamente!';
        }
    }
}
