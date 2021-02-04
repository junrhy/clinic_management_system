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
            $table->datetime('final_due_at');
            $table->string('currency');
            $table->double('amount_due');
            $table->double('tax')->nullable();
            $table->double('discount')->nullable();
            $table->double('unpaid_subscription')->nullable();
            $table->double('penalties')->nullable();
            $table->double('interest')->nullable();
            $table->string('payment_reference_no')->nullable();
            $table->datetime('last_payment_date')->nullable();
            $table->string('last_payment_transaction_no')->nullable();
            $table->string('last_payment_applicable_months')->nullable();
            $table->double('last_payment_amount')->nullable();
            $table->double('outstanding_balance')->nullable();
            $table->double('advance_payment')->nullable();
            $table->boolean('is_latest')->nullable();
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
