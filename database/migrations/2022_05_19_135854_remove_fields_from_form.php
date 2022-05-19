<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsFromForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('career_popup_pages', function (Blueprint $table) {
            $table->dropColumn('name_label');
            $table->dropColumn('email_label');
            $table->dropColumn('phone_label');
            $table->dropColumn('social_media_label');
        });

        Schema::table('thank_for_requests', function (Blueprint $table) {
            $table->dropColumn('close_button_title');
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
            $table->json('name_label')->nullable();
            $table->json('email_label')->nullable();
            $table->json('phone_label')->nullable();
            $table->json('social_media_label')->nullable();
        });

        Schema::table('thank_for_requests', function (Blueprint $table) {
            $table->json('close_button_title')->nullable();
        });
    }
}
