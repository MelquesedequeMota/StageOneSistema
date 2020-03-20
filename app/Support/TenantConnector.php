<?php
namespace App\Support;
use App\Http\Models\Pessoas;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
trait TenantConnector {
   
   /**
    * Altera a conexão tenant para a pessoas selecionada
    * @param pessoas $pessoas
    * @return void
    * @throws
    */
   public function reconnect(Pessoas $pessoas) {     
      // Apaga a conexão tenant, forçando o Laravel a voltar suas configurações de conexão para o padrão.
      DB::purge('tenant');
      
      // Setando os dados da nova conexão.
      if(strlen($pessoas->cpfcnpjpessoa) != 10 && strlen($pessoas->cpfcnpjpessoa) != 13){
         Config::set('database.connections.tenant.database', 'c'.$pessoas->cpfcnpjpessoa);
      }else{
         Config::set('database.connections.tenant.database', 'c0'.$pessoas->cpfcnpjpessoa);
      }
      Config::set('database.connections.tenant.username', 'root');
      
      // Conecta no banco
      DB::reconnect('tenant');
      // Testa a nova conexão
      Schema::connection('tenant')->getConnection()->reconnect();
   }
   
}