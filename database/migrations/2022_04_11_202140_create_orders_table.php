<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('entregue');
            $table->tinyInteger('operadora_cartoes');
            $table->tinyInteger('tipo_entrega');
            $table->tinyInteger('ponto');
            $table->integer('user_id');
            $table->date('data_combinada');
            $table->date('data');
            $table->smallInteger('mes');
            $table->smallInteger('ano');
            $table->decimal('total',8,2);
            $table->decimal('desconto',8,2);
            $table->string('comissao');
            $table->string('comissao_gestao');
            $table->tinyInteger('status');
            $table->tinyInteger('notafiscal');
            $table->string('canal');
            $table->string('obs');
            $table->tinyInteger('origem');
            $table->integer('vendedor');
            $table->integer('operador');
            $table->tinyInteger('check');
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
        Schema::dropIfExists('orders');
    }
};
