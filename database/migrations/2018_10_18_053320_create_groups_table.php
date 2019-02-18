<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 100);
            $table->integer("status")->default(1);
            $table->string('class', 50)->nullable()->comment('Tipo de grupo : Liga | FaseGrupos');
            $table->integer('classification_num')->default(0);

            $table->integer("tournament_id")->unsigned();
            $table->foreign("tournament_id")->references("id")->on("tournaments");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
