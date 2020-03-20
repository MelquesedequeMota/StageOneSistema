<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $primarykey = 'idvenda';
    protected $connection = 'tenant';
    protected $fillable = [
        'idvenda',
        'caixavenda',
        'datavenda',
    ];
    public $timestamps = false;
}
