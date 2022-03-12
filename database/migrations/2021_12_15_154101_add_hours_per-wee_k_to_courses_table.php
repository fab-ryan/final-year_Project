<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoursPerWeeKToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("courses", function (Blueprint $table) {
            $table
                ->integer("hours_per_week")
                ->unsigned()
                ->after("course_credit")
                ->onDelete("SET NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("courses", function (Blueprint $table) {
            //
        });
    }
}
