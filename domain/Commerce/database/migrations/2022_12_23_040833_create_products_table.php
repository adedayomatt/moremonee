<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->float('price')->nullable()->default(0);
            $table->string('currency')->nullable()->default('USD');
            $table->integer('in_stock')->nullable()->default(0);
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->json('media')->nullable();
            $table->enum('status', ['enabled', 'disabled'])->default("disabled");
            $table->json("metadata")->nullable();
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
        Schema::dropIfExists('products');
    }
}
