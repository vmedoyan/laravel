<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ObjectsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_object', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('object_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->
                onUpdate('cascade')->onDelete('cascade');

            $table->foreign('object_id')->references('id')->on('objects')->
                onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_object');
    }
}
