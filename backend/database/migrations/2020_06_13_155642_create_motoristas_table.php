<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotoristasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motoristas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('senha');
            $table->string('celular');
            $table->date('data_nascimento')->nullable();
            $table->string('numero_cnh')->nullable();
            $table->string('categoria_cnh')->nullable();
            $table->date('vencimento_cnh')->nullable();
            $table->string('rntrc')->nullable();
            $table->string('cep')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->unsignedBigInteger('cidade_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->rememberToken();
            $table->timestamp('criado_em')->nullable();
            $table->timestamp('atualizado_em')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motoristas');
    }
}
