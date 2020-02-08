<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sugestao extends Model
{
    protected $primarykey = 'idsugestao';
    protected $fillable = [
        'idsugestao',
        'sugestao'
    ];
    public $timestamps = false;
}
