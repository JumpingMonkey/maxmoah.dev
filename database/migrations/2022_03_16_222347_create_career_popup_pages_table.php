<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerPopupPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_popup_pages', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('vacancy_title')->nullable();
            $table->json('name_label');
            $table->json('email_label');
            $table->json('phone_label');
            $table->json('social_media_label');
            $table->json('upload_label');
            $table->json('agree_text');
            $table->json('privacy_policy_link_text');
            $table->json('privacy_policy_link')->nullable();
            $table->json('button_title');
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
        Schema::dropIfExists('career_popup_pages');
    }
}
