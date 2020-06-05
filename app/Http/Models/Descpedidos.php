<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Descpedidos extends Model
{
    protected $primarykey = 'iddescpedidos';
    protected $connection = 'tenant';
    protected $fillable = [
        'iddescpedidos',
        'idpedido',
        'nomeproduto',
        'quantidadepedido'
    ];
    public $timestamps = false;
}
