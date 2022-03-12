<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssignedCourseToCourseLecture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("course_lectures", function (Blueprint $table) {
            //
            $table
                ->boolean("assigned")
                ->default(0)
                ->after("course_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("course_lectures", function (Blueprint $table) {
            //
        });
    }
}
