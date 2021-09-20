<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltersModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters_models', function (Blueprint $table) {
            $table->id();
            $table->json('prod_category_filter_title');
            $table->json('sort_title');
            $table->json('price_highest_label');
            $table->json('price_lowest_label');
            $table->json('newest_label');
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
        Schema::dropIfExists('filters_models');
    }
}
