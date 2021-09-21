<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsNoReplyColumnToMessageRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_rooms', function (Blueprint $table) {
            $table->boolean('is_no_reply')->nullable()->after('is_for_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_rooms', function (Blueprint $table) {
            $table->dropColumn('is_no_reply');
        });
    }
}
