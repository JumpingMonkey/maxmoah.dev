<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('event_variant');
            $table->json('name_field_title');
            $table->json('email_field_title');
            $table->json('phone_field_title');
            $table->json('privacy_policy_text');
            $table->json('privacy_policy_link_text');
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
        Schema::dropIfExists('event_registrations');
    }
}
