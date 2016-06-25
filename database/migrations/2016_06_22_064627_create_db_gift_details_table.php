<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbGiftDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_gift_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('gift_id');
            $table->boolean('send_gift');
            $table->boolean('receive_gift');
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
        Schema::drop('db_gift_details');
    }
}
