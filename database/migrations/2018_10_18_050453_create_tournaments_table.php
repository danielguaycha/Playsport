<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 150);
            $table->date("date_init");
            $table->date("date_end");
            $table->enum("type", ["Male", "Female"]);
            $table->string("logo", 100);
            $table->string("portada", 100)->nullable();
            $table->string("url", 100)->nullable();
            $table->integer('priority')->default(5);
            #Status>>-1: Eliminado | 0: En proceso | 1: Finalizado
            $table->integer("status")->default(0);
            $table->longText("rules")->nullable();

            $table->integer("sports_id")->unsigned();
            $table->integer("organizations_id")->unsigned();

            $table->foreign("sports_id")->references("id")->on("sports");
            $table->foreign('organizations_id')->references('id')->on('organizations');

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
        Schema::dropIfExists('tournaments');
    }
}
