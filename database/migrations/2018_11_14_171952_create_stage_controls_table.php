<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStageControlsTable extends Migration
{
    public function up()
    {
        Schema::create('stage_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("team_old");
            $table->integer("team_new");
            $table->integer("time_table_id")->unsigned();
            $table->string("team", 15);

            $table->foreign("time_table_id")->references("id")->on("time_tables")->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stage_controls');
    }
}
