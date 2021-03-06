<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('rut');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token', 60)->nullable();
            $table->string('validation_token', 60)->nullable();
            $table->integer('subscription_id')
                ->unsigned()
                ->default(1);
            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
