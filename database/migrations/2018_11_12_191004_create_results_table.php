<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("result_a")->default(0);
            $table->integer("result_b")->default(0);

            $table->integer("penal_a")->default(0);
            $table->integer("penal_b")->default(0);

            $table->string("others_points", 20)->nullable();
            $table->string("desc", 250)->nullable();

            $table->integer("time_table_id")->unsigned();
            $table->foreign("time_table_id")->references("id")->on("time_tables");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
