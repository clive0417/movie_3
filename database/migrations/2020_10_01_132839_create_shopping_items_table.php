<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedInteger('count');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_items', function (Blueprint $table) {

            $table->dropForeign(['order_id']);
            $table->dropForeign(['movie_id']);


        });
        Schema::dropIfExists('shopping_items');
    }
}
