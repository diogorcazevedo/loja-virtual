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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('order_id');
            $table->decimal('price',8,2);
            $table->decimal('preco_de_venda',8,2);
            $table->integer('qtd');
            $table->string('aro1',5);
            $table->string('aro2',5);
            $table->tinyInteger('type');
            $table->string('img_url');
            $table->tinyInteger('status');
            $table->tinyInteger('devolucao');
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
        Schema::dropIfExists('order_items');
    }
};
