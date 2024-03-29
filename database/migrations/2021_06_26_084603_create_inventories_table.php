<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->float('qty');
            $table->double('price')->nullable();
            $table->date('expire_at')->nullable();
            $table->string('location')->nullable();
            $table->string('created_by');
            $table->string('status')->default('IN');
            $table->boolean('is_hidden')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
