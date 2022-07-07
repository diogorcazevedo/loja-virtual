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
        Schema::create('order_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->string('bandeira',80);
            $table->string('name');
            $table->string('number',50);
            $table->string('expiry',20);
            $table->string('parcelas',20);
            $table->string('cvv',5);
            $table->tinyInteger('checked');
            $table->tinyInteger('status');
            $table->tinyInteger('operadora');
            $table->string('cod_retorno',150);
            $table->string('status_message');
            $table->string('message');
            $table->string('error_message');
            $table->string('return_code_number');
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
        Schema::dropIfExists('order_data');
    }
};
