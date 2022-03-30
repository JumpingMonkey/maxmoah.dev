<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveHeroFieldsToMainPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_page_models', function (Blueprint $table) {
            $table->dropColumn('hero_bg_image');
            $table->dropColumn('hero_title');
            $table->dropColumn('hero_description');
            $table->dropColumn('hero_btn_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_page_models', function (Blueprint $table) {
            $table->json('hero_bg_image');
            $table->json('hero_title');
            $table->json('hero_description');
            $table->json('hero_btn_title');
        });
    }
}
