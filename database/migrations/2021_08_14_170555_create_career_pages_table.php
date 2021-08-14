<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_pages', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('vacancies')->nullable();
            $table->json('bottom_description');
            $table->json('first_bottom_field');
            $table->json('second_bottom_field');
            $table->json('third_bottom_field');
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('key_words');
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
        Schema::dropIfExists('career_pages');
    }
}
