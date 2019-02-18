<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("yellow")->default(0);
            $table->integer("red")->default(0);
            $table->integer("goals")->default(0);
            $table->integer("value")->default(0)->comment("additional value");
            $table->string("observation", 255);

            $table->integer("tournament_id")->unsigned();
            $table->integer("player_id")->unsigned();
            $table->integer("team_id")->unsigned();
            $table->integer("time_table_id")->unsigned()->nullable();


            $table->foreign("tournament_id")->references("id")->on("tournaments");
            $table->foreign("player_id")->references("id")->on("players");
            $table->foreign("team_id")->references("id")->on("teams");
            $table->foreign("time_table_id")->references("id")->on("time_tables")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
