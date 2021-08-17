<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeRequestPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_request_pages', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('name_field_title');
            $table->json('email_field_title');
            $table->json('message_field_title');
            $table->json('subject_variant');
            $table->json('privacy_policy_label');
            $table->json('button_title');
            $table->json('close_button_title');
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
        Schema::dropIfExists('make_request_pages');
    }
}
