<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoLojasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco_lojas', function (Blueprint $table) {
            $table->id('id_endereco_lojas');
            $table->unsignedInteger('id_lojas');
            $table->string('logradouro', 80);
            $table->unsignedMediumInteger('numero');
            $table->string('complemento', 50)->nullable();
            $table->char('cep', 8);
            $table->string('bairro', 80);
            $table->string('cidade', 80);
            $table->char('UF', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco_lojas');
    }
}
