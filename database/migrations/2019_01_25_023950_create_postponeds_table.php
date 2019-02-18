<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostponedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postponeds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 255);
            $table->string('justify', 100)->nullable();
            $table->integer('time_table_id_old');
            $table->integer('time_table_id_new')->unsigned();
            $table->timestamps();

            $table->foreign('time_table_id_old')->references('id')->on('time_tables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postponeds');
    }
}
