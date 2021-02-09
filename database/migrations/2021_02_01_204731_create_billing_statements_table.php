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
            $table->double('amount_past_due')->nullable();
            $table->double('amount_due');
            $table->double('discount')->nullable();
            $table->double('penalties')->nullable();
            $table->double('advance_payment')->nullable();
            $table->string('payment_reference_no')->nullable();
            $table->boolean('is_latest')->nullable();
            $table->boolean('is_publish')->default(0);
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
