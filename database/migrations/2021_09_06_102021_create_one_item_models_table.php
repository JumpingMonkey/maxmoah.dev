<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneItemModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one_item_models', function (Blueprint $table) {
            $table->id();
            $table->json('meta_title');
            $table->json('meta_description');
            $table->json('key_words');

            $table->json('zoom_in_btn_title');
            $table->json('prod_photo');

            $table->foreignId('tag_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            $table->json('prod_title');
            $table->string('prod_slug');
            $table->string('available');
            $table->string('customize');
            $table->json('prod_price');
            $table->string('bg_img_first_screen');
            $table->json('content');
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
        Schema::dropIfExists('one_item_models');
    }
}
