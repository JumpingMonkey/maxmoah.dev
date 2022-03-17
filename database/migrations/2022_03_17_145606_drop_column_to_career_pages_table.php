<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnToCareerPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_pages', function (Blueprint $table) {
            $table->dropColumn('third_bottom_field');
            $table->renameColumn('first_bottom_field', 'button_in_the_bottom_text');
            $table->renameColumn('second_bottom_field', 'popup_button_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('career_pages', function (Blueprint $table) {
            $table->json('third_bottom_field');
            $table->renameColumn('button_in_the_bottom_text', 'first_bottom_field');
            $table->renameColumn('popup_button_text', 'second_bottom_field');
        });
    }
}
