<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $primarykey = 'idunidade';
    protected $connection = 'tenant';
    protected $fillable = [
        'idunidade',
        'cpfcnpjunidade',
        'nomeunidade',
    ];
    public $timestamps = false;
}
