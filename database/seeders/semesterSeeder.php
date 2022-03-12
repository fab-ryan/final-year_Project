<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class semesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = [
            ["semester_name" => "semester 1"],
            ["semester_name" => "semester 2"],
        ];
        foreach ($semesters as $semester) {
            $existing = DB::table("semesters")
                ->where("semester_name", $semester["semester_name"])
                ->first();

            if (!$existing) {
                DB::table("semesters")->insert($semester);
            }
        }
    }
}
