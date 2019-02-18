<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pj")->default(0);
            $table->integer("gf")->default(0);
            $table->integer("gc")->default(0);
            $table->integer("pts")->default(0);
            $table->integer("pg")->default(0);
            $table->integer("pe")->default(0);
            $table->integer("pp")->default(0);

            $table->integer("group_id")->unsigned();
            $table->integer("team_id")->unsigned();

            $table->timestamps();
            $table->foreign("team_id")->references("id")->on("teams")->onDelete('cascade');
            $table->foreign("group_id")->references("id")->on("groups")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_groups');
    }
}
