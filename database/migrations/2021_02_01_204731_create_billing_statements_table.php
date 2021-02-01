<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('billing_statements');
        
        Schema::create('billing_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->datetime('billed_at');
            $table->datetime('due_at');
            $table->string('currency');
            $table->integer('amount_due');
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('unpaid_subscription')->nullable();
            $table->integer('penalties')->nullable();
            $table->integer('interest')->nullable();
            $table->string('payment_reference_no')->nullable();
            $table->integer('address_id');
            $table->datetime('last_payment_date')->nullable();
            $table->string('last_payment_transaction_no')->nullable();
            $table->string('last_payment_applicable_months')->nullable();
            $table->integer('last_payment_amount')->nullable();
            $table->integer('outstanding_balance')->nullable();
            $table->integer('advance_payment')->nullable();
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
        Schema::dropIfExists('billing_statements');
    }
}
