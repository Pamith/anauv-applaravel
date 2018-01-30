<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetailersProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailersProfile', function (Blueprint $table) {
            $table->integer('retailer_id')->unsigned();
            $table->foreign('retailer_id')->references('id')->on('users');
            $table->string('shopname')->nullable();
            $table->longText('type')->nullable();
            $table->longText('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->tinyInteger('verified')->default(0);
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
        Schema::dropIfExists('retailersProfile');
    }
}
