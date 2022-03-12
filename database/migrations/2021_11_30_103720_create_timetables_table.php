<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("timetables", function (Blueprint $table) {
            $table->id();
            $table->string("timetable_name");
            $table
                ->foreignId("department_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("level_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("setting_id")
                ->constrained()
                ->onDelete("cascade");
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
        Schema::dropIfExists("timetables");
    }
}
