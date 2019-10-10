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
            $table->string('email', 150)->unique();
            $table->string('account_type')->default('basic');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_suspended')->default(0);
            $table->string('paypal_subscr_id')->nullable();
            $table->string('payer_first_name')->nullable();
            $table->string('payer_last_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('payment_receiver_email')->nullable();
            $table->string('paypal_subscr_date')->nullable();
            $table->string('payment_fee')->nullable();
            $table->string('paypal_payment_date')->nullable();
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
