<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("student_infos", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained()
                ->onDelete("cascade");
            $table->string("regno");
            $table->string("phone_number", 13);
            $table
                ->foreignId("department_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("level_id")
                ->constrained()
                ->onDelete("cascade");
            $table
                ->foreignId("class_rooms_id")
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
        Schema::dropIfExists("student_infos");
    }
}
