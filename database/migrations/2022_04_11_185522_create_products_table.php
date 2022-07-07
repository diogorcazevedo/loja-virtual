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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('collection_id');
            $table->string('name');
            $table->string('slug');
            $table->tinyInteger('ativo');
            $table->tinyInteger('publish');
            $table->integer('tiny_id');
            $table->integer('line_up');
            $table->string('keywords');
            $table->string('description');
            $table->string('ncm',50);
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
        Schema::dropIfExists('products');
    }
};
