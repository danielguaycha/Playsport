<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->date("date");
            $table->time("hour");
            $table->string("place", 255);
            $table->integer("status")->default(-1);

            $table->integer("team_id_a")->unsigned();
            $table->integer("team_id_b")->unsigned();
            $table->integer("stage_id")->unsigned()->nullable();
            $table->integer("group_id")->unsigned()->nullable();

            $table->foreign("team_id_a")->references("id")->on('teams');
            $table->foreign("team_id_b")->references("id")->on('teams');
            $table->foreign("group_id")->references("id")->on('groups');
            $table->foreign("stage_id")->references("id")->on('stages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
}
