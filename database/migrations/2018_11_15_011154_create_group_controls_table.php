<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_controls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pj")->default(0);
            $table->integer("pg")->default(0);
            $table->integer("pe")->default(0);
            $table->integer("pp")->default(0);
            $table->integer("gf")->default(0);
            $table->integer("gc")->default(0);
            $table->integer("pts")->default(0);
            $table->integer("time_table_id")->unsigned();
            $table->integer("team_group_id")->unsigned();
            $table->integer('team_id');

            $table->foreign('time_table_id')->references("id")->on("time_tables")->onDelete('cascade');
            $table->foreign('team_group_id')->references("id")->on("team_groups")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_controls');
    }
}
