<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('prescriptions');
        
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('patient_id');
            $table->integer('clinic_id');
            $table->integer('doctor_id');
            $table->string('clinic');
            $table->string('doctor');
            $table->text('prescription');
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
        Schema::dropIfExists('prescriptions');
    }
}
