<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('shoppingitems', function (Blueprint $table) {
            $table->string('title');
            $table->longText('posterUrl');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppingitems', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('posterUrl');
        });
    }

}
