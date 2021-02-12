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
        Schema::dropIfExists('clients');
        
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email', 150);
            $table->boolean('is_email_verified')->default(0);
            $table->string('secondary_email', 150)->nullable();
            $table->boolean('is_email2_verified')->default(0);
            $table->string('contact')->nullable();
            $table->boolean('is_contact_verified')->default(0);
            $table->string('logo')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_type')->default('free');
            $table->string('app_license_no')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('is_vip')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_suspended')->default(0);
            $table->boolean('is_disconnected')->default(0);
            $table->text('disconnection_reason')->nullable();
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
