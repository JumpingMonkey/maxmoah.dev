<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrunkShowMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trunk_show_messages', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->text('phone');
            $table->text('region');
            $table->text('country');
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
        Schema::dropIfExists('trunk_show_messages');
    }
}
