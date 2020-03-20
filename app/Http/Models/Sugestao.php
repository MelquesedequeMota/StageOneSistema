<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    protected $primarykey = 'idsugestao';
    protected $connection = 'tenant';
    protected $fillable = [
        'idsugestao',
        'sugestao'
    ];
    public $timestamps = false;
}
