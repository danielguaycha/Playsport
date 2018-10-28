<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {

            $table->increments('id');
            $table->string("name", 100);
            $table->decimal("duration", 10, 2);
            $table->integer("status")->default(1);
            $table->integer("min_players")->default(0);
            $table->integer("max_players")->default(0);
            $table->string("denomination", 20)->nullable()->comment("Goals, Points");
            $table->longText("rules");
            $table->string("logo",100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sports');
    }
}
