<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineApointmentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_apointment_messages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('language');
            $table->text('email');
            $table->text('phone');
            $table->text('date');
            $table->text('time');
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
        Schema::dropIfExists('online_apointment_messages');
    }
}
