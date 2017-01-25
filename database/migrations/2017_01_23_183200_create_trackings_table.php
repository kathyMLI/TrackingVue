<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->boolean('delivered');
            $table->json('history')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });

        Schema::create('tracking_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('tracking_id')->unsigned();
            $table->string('description')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('tracking_id')
                ->references('id')
                ->on('trackings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tracking_user');
        Schema::dropIfExists('trackings');
    }
}
