<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_producto');
            $table->string('sku')->unique();
            $table->text('descripcion');
            $table->integer('valor');
            $table->string('imagen');
            $table->unsignedBigInteger('tienda_id');
            $table->timestamps();
            $table->foreign('tienda_id') ->references('id')->on('tiendas')  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
