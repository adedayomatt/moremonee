<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_service_requests', function (Blueprint $table) {
            $table->id();
            $table->string("service")->nullable();
            $table->string("activity")->nullable();
            $table->string("reference")->nullable();
            $table->string("url")->nullable();
            $table->string("method")->nullable();
            $table->longText("headers")->nullable();
            $table->longText("request")->nullable();
            $table->longText("response")->nullable();
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
        Schema::dropIfExists('external_service_requests');
    }
}
