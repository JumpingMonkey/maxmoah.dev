<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVacancyTitleColumnToCareerPopupPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_popup_pages', function (Blueprint $table) {
            $table->dropColumn('vacancy_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career_popup_pages', function (Blueprint $table) {
            $table->json('vacancy_title')->nullable();
        });
    }
}
