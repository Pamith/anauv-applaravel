<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('retailer_id');
            $table->string('ShopName');
            $table->longText('address')->nullable();
            $table->longText('latitude')->nullable();
            $table->longText('longitude')->nullable();
            $table->longText('category')->nullable();
            $table->longText('offer')->nullable();
            $table->longText('short_desc')->nullable();
            $table->longText('offer_desc')->nullable();
            $table->string('offer_start');
            $table->string('offer_end');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('offers_models');
    }
}
