<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrees', function (Blueprint $table){
            $table->id();
            $table->string('form_title')->nullable();
            $table->string('email_field_title')->nullable();
            $table->string('checkbox_text')->nullable();
            $table->string('term_of_service_text')->nullable();
            $table->string('term_of_service_link_text')->nullable();
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
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
        Schema::dropIfExists('agrees');
    }
}
