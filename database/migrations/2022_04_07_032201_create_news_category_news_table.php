<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsCategoryNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_category_news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('one_news_id')->unsigned();
            $table->foreign('one_news_id')->references('id')->on('one_news')->onDelete('cascade');
            $table->bigInteger('news_category_id')->unsigned();
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
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
        Schema::dropIfExists('news_category_news');
    }
}
