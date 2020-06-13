<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('nome');
            $table->string('cep');
            $table->string('bairro');
            $table->string('logradouro');
            $table->string('complemento')->nullable();
            $table->string('numero')->nullable();
            $table->enum('sentido', ['norte', 'sul', 'leste', 'oeste', 'nordeste', 'noroeste', 'sudeste', 'sudoeste']);
            $table->string('rodovia');
            $table->string('km');
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean('aceita_reserva');
            $table->decimal('valor_estadia', 12, 2)->nullable();
            $table->json('tags');
            $table->integer('vagas');
            $table->integer('chuveiros_masculinos');
            $table->integer('chuveiros_femininos');
            $table->integer('banheiros_masculinos');
            $table->integer('banheiros_femininos');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')->references('id')->on('cidades');
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
        Schema::dropIfExists('locais');
    }
}
