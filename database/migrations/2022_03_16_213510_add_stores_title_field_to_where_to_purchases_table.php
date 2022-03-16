<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoresTitleFieldToWhereToPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('where_to_purchases', function (Blueprint $table) {
            $table->json('stores_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('where_to_purchases', function (Blueprint $table) {
            $table->dropColumn('stores_title');
        });
    }
}
