<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDatatimeFieldsFromPrivateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('private_appointments', function (Blueprint $table) {
            $table->dropColumn('dd_field_title');
            $table->dropColumn('mm_field_title');
            $table->dropColumn('yyyy_field_title');
        });

        Schema::table('privat_appointment_messages', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('private_appointments', function (Blueprint $table) {
            $table->json('dd_field_title');
            $table->json('mm_field_title');
            $table->json('yyyy_field_title');
        });

        Schema::table('privat_appointment_messages', function (Blueprint $table) {
            $table->string('date');
        });
    }
}
