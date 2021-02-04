<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientBillingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_billing_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->double('amount');
            $table->string('currency');
            $table->string('payment_reference_no');
            $table->string('payment_transaction_no');
            $table->string('mode_of_payment');
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
        Schema::dropIfExists('client_billing_payments');
    }
}
