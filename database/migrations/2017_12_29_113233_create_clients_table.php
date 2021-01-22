<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 150);
            $table->string('secondary_email', 150)->nullable();
            $table->string('contact')->nullable();
            $table->string('logo')->nullable();
            $table->string('account_type')->default('free');
            $table->string('app_license_no')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_suspended')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
