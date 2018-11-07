<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 100);
            $table->string("alias", 50)->nullable();
            $table->enum("type", ["Male", "Female"]);
            $table->string("logo", 100);
            $table->integer("organization_id")->unsigned();
            $table->integer("sport_id")->unsigned();
            $table->integer('status')->default(0);
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('sport_id')->references('id')->on('sports');

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
        Schema::dropIfExists('teams');
    }
}
