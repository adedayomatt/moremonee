<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("order_id")->unsigned()->nullable();
            $table->string("reference");
            $table->string("provider")->nullable();
            $table->string("provider_reference")->nullable();
            $table->float("amount");
            $table->string("currency");
            $table->enum("status", ["success", "pending", "failed"])->default("pending");
            $table->json("metadata")->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
