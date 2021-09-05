<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('name');
            $table->string('member_user_ids');
            $table->string('read_by_user_ids');
            $table->boolean('is_for_admin')->default(0);
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
        Schema::dropIfExists('message_rooms');
    }
}
