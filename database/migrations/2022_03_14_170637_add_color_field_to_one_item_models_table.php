<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorFieldToOneItemModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_item_models', function (Blueprint $table) {
            $table->json('color')->nullable();
            $table->dropColumn('color_one');
            $table->dropColumn('color_two');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('one_item_models', function (Blueprint $table) {
            $table->string('color_one')->nullable();
            $table->string('color_two')->nullable();
            $table->dropColumn('color');
        });
    }
}
