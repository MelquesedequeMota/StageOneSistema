<?php

namespace App\Http\Models;
use App\Support\TenantConnector;
use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    use TenantConnector;
       
    protected $connection = 'sistemaestoque';
    protected $primaryKey = 'cpfcnpjpessoa';
    /**
     * @return $this
     */
    public function connect() {
        $this->reconnect($this);
        return $this;
    }
}
