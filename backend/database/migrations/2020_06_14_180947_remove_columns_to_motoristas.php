<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsToMotoristas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropForeign(['cidade_id']);
            $table->dropColumn(['data_nascimento']);
            $table->dropColumn(['numero_cnh']);
            $table->dropColumn(['vencimento_cnh']);
            $table->dropColumn(['tags_cnh']);
            $table->dropColumn(['rntrc']);
            $table->dropColumn(['cep']);
            $table->dropColumn(['logradouro']);
            $table->dropColumn(['numero']);
            $table->dropColumn(['complemento']);
            $table->dropColumn(['bairro']);
            $table->dropColumn(['cidade_id']);
            $table->dropColumn(['estado_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('motoristas', function (Blueprint $table) {
            $table->date('data_nascimento')->nullable();
            $table->string('numero_cnh')->nullable();
            $table->string('tags_cnh')->nullable();
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
        });
    }
}
