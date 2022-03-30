<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBgImgOrVideoColumnToFlagPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flag_pages', function (Blueprint $table) {
            $table->json('background_photo_video');
            $table->string('filter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flag_pages', function (Blueprint $table) {
            $table->dropColumn('background_photo_video');
            $table->dropColumn('filter');
        });
    }
}
