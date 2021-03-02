<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->unsigned();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('street');
            $table->string('neighborhood');
            $table->string('number')->nullable();
            $table->text('complement')->nullable();
            $table->text('lat')->nullable();
            $table->text('long')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('property_addresses');
    }
}
