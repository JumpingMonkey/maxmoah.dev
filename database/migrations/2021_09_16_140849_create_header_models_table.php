<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_models', function (Blueprint $table) {
            $table->id();
            $table->json('site_name');
            $table->json('menu_name');
            $table->json('make_appointment');
            $table->json('burger_close_btn_label');
            $table->json('header_navigation');
            $table->json('sub_header_navigation');
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
        Schema::dropIfExists('header_models');
    }
}
