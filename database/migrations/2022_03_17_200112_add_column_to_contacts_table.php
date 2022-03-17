<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->json('phone_number_description')->nullable();
            $table->json('email_for_press_inquires_description')->nullable();
            $table->json('email_general_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('phone_number_description');
            $table->dropColumn('email_for_press_inquires_description');
            $table->dropColumn('email_general_description');
        });
    }
}
