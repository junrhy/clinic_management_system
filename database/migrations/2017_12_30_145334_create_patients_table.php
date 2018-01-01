<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name_of_father')->nullable();
            $table->string('name_of_mother')->nullable();
            $table->string('mother_maiden_name')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('number_of_children')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('town')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_contact_number')->nullable();
            $table->string('emergency_contact_name1')->nullable();
            $table->string('emergency_contact_number1')->nullable();
            $table->string('emergency_contact_name2')->nullable();
            $table->string('emergency_contact_number2')->nullable();
            $table->string('emergency_contact_name3')->nullable();
            $table->string('emergency_contact_number3')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
