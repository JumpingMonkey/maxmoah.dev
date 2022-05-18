<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckboxContentToFooterModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_available_page_models', function (Blueprint $table){
            $table->dropColumn('checkbox_text');
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('term_of_service_text');
            $table->dropColumn('term_of_service_link_text');
        });

        Schema::table('full_collection_page_models', function (Blueprint $table){
            $table->dropColumn('checkbox_text');
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('term_of_service_text');
            $table->dropColumn('term_of_service_link_text');
        });

        Schema::table('career_popup_pages', function (Blueprint $table){
            $table->dropColumn('privacy_policy_link');
            $table->dropColumn('privacy_policy_link_text');
        });

        Schema::table('online_appointments', function (Blueprint $table){
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('close_button_title');
        });

        Schema::table('event_registrations', function (Blueprint $table){
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('close_button_title');
        });

        Schema::table('private_appointments', function (Blueprint $table){
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('close_button_title');
        });

        Schema::table('make_request_pages', function (Blueprint $table){
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
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
        Schema::table('product_available_page_models', function (Blueprint $table){
            $table->string('checkbox_text')->nullable();
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('term_of_service_text')->nullable();
            $table->string('term_of_service_link_text')->nullable();
        });

        Schema::table('full_collection_page_models', function (Blueprint $table){
            $table->string('checkbox_text')->nullable();
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('term_of_service_text')->nullable();
            $table->string('term_of_service_link_text')->nullable();
        });

        Schema::table('career_popup_pages', function (Blueprint $table){
            $table->string('privacy_policy_link')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
        });

        Schema::table('online_appointments', function (Blueprint $table){
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('close_button_title')->nullable();
        });

        Schema::table('event_registrations', function (Blueprint $table){
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('close_button_title')->nullable();
        });

        Schema::table('private_appointments', function (Blueprint $table){
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('close_button_title')->nullable();
        });

        Schema::table('make_request_pages', function (Blueprint $table){
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('close_button_title')->nullable();
        });
    }
}
