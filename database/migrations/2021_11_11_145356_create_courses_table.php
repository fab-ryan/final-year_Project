<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("courses", function (Blueprint $table) {
            $table->id();
            $table->string("course_code", 10)->nullable(false);

            $table->string("course_name", 25);
            $table->integer("course_credit", false)->unsigned();
            $table
                ->foreignId("department_id")
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
        Schema::dropIfExists("courses");
    }
}
