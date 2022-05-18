<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveArgeeFieldsToTrunkShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trunk_shows', function (Blueprint $table) {
            $table->dropColumn('privacy_policy_text');
            $table->dropColumn('privacy_policy_link_text');
            $table->dropColumn('close_button_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trunk_shows', function (Blueprint $table) {
            $table->string('privacy_policy_text')->nullable();
            $table->string('privacy_policy_link_text')->nullable();
            $table->string('close_button_title')->nullable();
        });
    }
}
