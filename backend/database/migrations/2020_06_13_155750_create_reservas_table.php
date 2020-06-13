<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->enum('status', ['Aguardando motorista', 'Cancelada', 'Motorista chegou']);
            $table->timestamp('data_chegada_em')->nullable();
            $table->timestamp('data_saida_em')->nullable();
            $table->unsignedBigInteger('motorista_id');
            $table->foreign('motorista_id')->references('id')->on('motoristas');
            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id')->references('id')->on('locais');
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
        Schema::dropIfExists('reservas');
    }
}
