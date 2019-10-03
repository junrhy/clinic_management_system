<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('patient_id');
            $table->integer('doctor_id')->default(0);
            $table->string('service')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_scheduled');
            $table->date('date_scheduled')->nullable();
            $table->time('time_scheduled')->nullable();
            $table->boolean('is_archived')->default(0);
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
        Schema::dropIfExists('patient_details');
    }
}
