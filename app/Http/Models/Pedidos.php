<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $primarykey = 'idpedido';
    protected $connection = 'tenant';
    protected $fillable = [
        'idpedido',
        'nomepedido',
        'datapedido',
        'statuspedido'
    ];
    public $timestamps = false;
}
