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
            $table->date("date")->nullable();
            $table->time("hour")->nullable();
            $table->string("place", 255)->nullable();
            #Status>>-2 Pospuesto | -1: Por jugarse | 0: En proceso | 1: Finalizado | 2: Finalizado en penales
            $table->integer("status")->default(-1)->comment('-1: Por jugarse | 0: En proceso | 1: Finalizado | 2: Finalizado en penales');
            $table->integer("team_id_a")->unsigned()->nullable();
            $table->integer("team_id_b")->unsigned()->nullable();
            $table->integer("stage_id")->unsigned()->nullable();
            $table->integer("group_id")->unsigned()->nullable();
            $table->integer("round_id")->unsigned()->nullable();

            $table->foreign("team_id_a")->references("id")->on('teams');
            $table->foreign("team_id_b")->references("id")->on('teams');
            $table->foreign("group_id")->references("id")->on('groups')->onDelete('cascade');
            $table->foreign("stage_id")->references("id")->on('stages')->onDelete('cascade');
            $table->foreign("round_id")->references("id")->on('rounds')->onDelete('cascade');
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
