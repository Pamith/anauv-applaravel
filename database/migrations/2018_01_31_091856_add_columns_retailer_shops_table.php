<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRetailerShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retailer_shops', function($table) {
            $table->increments('id')->first();
            $table->string('contact_name')->nullable()->after('retailer_id');
            $table->string('contact_email',100)->unique()->nullable()->after('retailer_id');
            $table->string('contact_mobile',100)->unique()->nullable()->after('retailer_id');
            $table->string('cantact_person')->nullable()->after('retailer_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::table('retailer_shops', function($table) {
            $table->dropColumn('contact_name');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_mobile');
            $table->dropColumn('cantact_person');
        });
    }
}
