<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications_subscribers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('token_firebase', 655);
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['all','question']);
            $table->integer('question_id')->unsigned()->nullable();
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
        Schema::dropIfExists('notifications_subscribers');
    }
}

//TODO => foregin key
