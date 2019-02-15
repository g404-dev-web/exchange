<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('answers', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('answer_id')->references('id')->on('answers')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('question_id')->references('id')->on('questions')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
        Schema::table('upvotes', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('answer_id')->references('id')->on('answers')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
