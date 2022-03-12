<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("levels", function (Blueprint $table) {
            $table->id();
            $table->string("level_name");
            $table
                ->foreignId("department_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("setting_id")
                ->constrained()
                ->onUpdate("cascade");
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
        Schema::dropIfExists("levels");
    }
}
