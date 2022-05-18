<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFullCollectionPageModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('full_collection_page_models', function (Blueprint $table) {
            $table->string('checkbox_text')->nullable();
            $table->string('term_of_service_text')->nullable();
            $table->string('term_of_service_link_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('full_collection_page_models', function (Blueprint $table) {
            $table->dropColumn('checkbox_text');
            $table->dropColumn('term_of_service_text');
            $table->dropColumn('term_of_service_link_text');
        });
    }
}
