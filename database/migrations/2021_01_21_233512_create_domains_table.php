<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('domains');
        
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('domain_name');
            $table->string('params')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_user')->nullable();
            $table->string('provider_pass')->nullable();
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
        Schema::dropIfExists('domains');
    }
}
