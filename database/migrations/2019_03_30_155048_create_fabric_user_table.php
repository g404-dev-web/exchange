<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_user', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('fabric_id');
            $table->primary(['user_id', 'fabric_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('fabric_id')->references('id')->on('fabrics');
        });
        DB::statement('insert into fabric_user(user_id, fabric_id, created_at, updated_at) select id, fabric_id, created_at, updated_at from users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabric_user');
    }
}
