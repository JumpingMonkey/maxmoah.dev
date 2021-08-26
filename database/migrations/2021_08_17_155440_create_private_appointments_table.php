<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_appointments', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('name_field_title');
            $table->json('email_field_title');
            $table->json('country_field_title');
            $table->json('phone_field_title');
            $table->json('dd_field_title');
            $table->json('mm_field_title');
            $table->json('yyyy_field_title');
            $table->json('time_field_title');
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
        Schema::dropIfExists('private_appointments');
    }
}
