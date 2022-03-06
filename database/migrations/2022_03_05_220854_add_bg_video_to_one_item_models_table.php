<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBgVideoToOneItemModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('one_item_models', function (Blueprint $table) {
            $table->string('bg_video_first_screen')->nullable();
            $table->string('color_one')->nullable();
            $table->string('color_two')->nullable();

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
            $table->dropColumn('bg_video_first_screen');
            $table->dropColumn('color_one');
            $table->dropColumn('color_two');
        });
    }
}
