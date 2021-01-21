<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('license_no')->nullable();
            $table->string('ptr_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
