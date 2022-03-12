<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomStatusToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("rooms", function (Blueprint $table) {
            $table
                ->foreignId("department_id")
                ->onDelete("SET NULL")
                ->after("description");
            $table
                ->boolean("status")
                ->default(1)
                ->after("description");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("rooms", function (Blueprint $table) {
            $table->dropColumn("status");
            $table->dropColumn("department_id");
        });
    }
}
