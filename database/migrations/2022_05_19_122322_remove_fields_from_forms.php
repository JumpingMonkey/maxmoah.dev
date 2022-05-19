<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsFromForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('full_collection_page_models', function (Blueprint $table) {
            $table->dropColumn('form_title');
            $table->dropColumn('email_field_title');
        });

        Schema::table('product_available_page_models', function (Blueprint $table) {
            $table->dropColumn('form_title');
            $table->dropColumn('email_field_title');
        });

        Schema::table('career_popup_pages', function (Blueprint $table) {
            $table->dropColumn('agree_text');
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumn('name_field_title');
            $table->dropColumn('email_field_title');
            $table->dropColumn('phone_field_title');
        });

        Schema::table('make_request_pages', function (Blueprint $table) {
            $table->dropColumn('name_field_title');
            $table->dropColumn('email_field_title');
            $table->dropColumn('phone_field_title');
            $table->dropColumn('message_field_title');
        });

        Schema::table('online_appointments', function (Blueprint $table) {
            $table->dropColumn('name_field_title');
            $table->dropColumn('language_field_title');
            $table->dropColumn('email_field_title');
            $table->dropColumn('phone_field_title');
            $table->dropColumn('calendar_field_title');
            $table->dropColumn('time_field_title');
        });

        Schema::table('private_appointments', function (Blueprint $table) {
            $table->dropColumn('name_field_title');
            $table->dropColumn('time_field_title');
            $table->dropColumn('email_field_title');
            $table->dropColumn('phone_field_title');
            $table->dropColumn('country_field_title');
            $table->dropColumn('calendar_title');
        });

        Schema::table('trunk_shows', function (Blueprint $table) {
            $table->dropColumn('name_field_title');
            $table->dropColumn('region_field_title');
            $table->dropColumn('email_field_title');
            $table->dropColumn('phone_field_title');
            $table->dropColumn('country_field_title');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('full_collection_page_models', function (Blueprint $table) {
            $table->json('form_title')->nullable();
            $table->json('email_field_title')->nullable();
        });

        Schema::table('product_available_page_models', function (Blueprint $table) {
            $table->json('form_title')->nullable();
            $table->json('email_field_title')->nullable();
        });

        Schema::table('career_popup_pages', function (Blueprint $table) {
            $table->json('agree_text')->nullable();
        });

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->json('name_field_title')->nullable();
            $table->json('email_field_title')->nullable();
            $table->json('phone_field_title')->nullable();
        });

        Schema::table('make_request_pages', function (Blueprint $table) {
            $table->json('name_field_title')->nullable();
            $table->json('email_field_title')->nullable();
            $table->json('phone_field_title')->nullable();
            $table->json('message_field_title')->nullable();
        });

        Schema::table('online_appointments', function (Blueprint $table) {
            $table->json('name_field_title')->nullable();
            $table->json('language_field_title')->nullable();
            $table->json('email_field_title')->nullable();
            $table->json('phone_field_title')->nullable();
            $table->json('calendar_field_title')->nullable();
            $table->json('time_field_title')->nullable();
        });

        Schema::table('private_appointments', function (Blueprint $table) {
            $table->json('name_field_title')->nullable();
            $table->json('time_field_title')->nullable();
            $table->json('email_field_title')->nullable();
            $table->json('phone_field_title')->nullable();
            $table->json('country_field_title')->nullable();
            $table->json('calendar_title')->nullable();
        });

        Schema::table('trunk_shows', function (Blueprint $table) {
            $table->json('name_field_title')->nullable();
            $table->json('region_field_title')->nullable();
            $table->json('email_field_title')->nullable();
            $table->json('phone_field_title')->nullable();
            $table->json('country_field_title')->nullable();

        });
    }
}
