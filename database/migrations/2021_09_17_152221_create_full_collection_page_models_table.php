<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullCollectionPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_collection_page_models', function (Blueprint $table) {
            $table->id();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('key_words');
            $table->json('title');
            $table->json('description');
            $table->json('message_if_no_items');
            $table->json('form_title');
            $table->json('email_field_title');
            $table->json('privacy_policy_text');
            $table->json('privacy_policy_link_text');
            $table->tinyInteger('filter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_collection_page_models');
    }
}
