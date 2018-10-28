<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 100);
            $table->integer("match_num")->default(0);
            $table->string("desc", 255)->nullable();
            $table->integer("status")->default(1);
            $table->integer("tournament_id")->unsigned();
            $table->integer("parent")->default(0);
            $table->foreign("tournament_id")->references("id")->on('tournaments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stages');
    }
}
