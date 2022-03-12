<?php

use App\Models\level;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelIdToCoursesTable extends Migration
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
                ->foreignId("level_id")

                ->onDelete("SET NULL")
                ->after("department_id");
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
            $table->dropConstrainedForeignId("level_id");
        });
    }
}
