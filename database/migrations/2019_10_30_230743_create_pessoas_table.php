<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->bigIncrements('idpessoa');
            $table->string('nomepessoa')->unique();
            $table->string('cpfcnpjpessoa')->unique();
            $table->string('ceppessoa')->unique();
            $table->string('emailpessoa')->unique();
            $table->string('enderecopessoa');
            $table->string('fonepessoa');
            $table->string('fone2pessoa')->nullable();
            $table->string('fone3pessoa')->nullable();
            $table->string('fone4pessoa')->nullable();
            $table->string('obspessoa')->nullable();
            $table->integer('tipoconta');
            $table->integer('vendedorid')->nullable();
            $table->string('permissaoconta');
            $table->string('senhapessoa');

        });
        DB::statement('ALTER TABLE pessoas CHANGE idpessoa idpessoa INT(5) ZEROFILL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
