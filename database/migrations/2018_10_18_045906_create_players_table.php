<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 100);
            $table->string("last_name", 100);
            $table->integer("age")->default(0);
            $table->string("dni", 20);
            $table->enum("type", ["Male", "Female"]);
            $table->integer('number')->default(0);
            $table->string("observations", 250)->nullable();
            $table->timestamps();

            $table->integer('organization_id')->unsigned()->nullable();
            $table->foreign("organization_id")->references("id")->on("organizations");
        });
    }
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
