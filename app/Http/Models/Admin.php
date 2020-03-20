<?php
namespace App\Http\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable {
   
   use Notifiable;
   
   protected $connection = 'sistemaestoque';
}