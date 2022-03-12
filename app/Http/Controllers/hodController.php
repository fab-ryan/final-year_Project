<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\hod_assignemnt;
use App\Models\settings;
use App\Models\classRoom;
use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class hodController extends Controller
{
    protected $course_count;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $comments = DB::table("hod_assignemnts")
            ->where("user_id", "=", $user_id)
            ->orderBy("id", "desc")
            ->first();
        $depart = $comments->department_id;
        $setting = settings::where("status", "=", 1)->first();
        $setting_id = $setting->id;

        $test = course::where([
            ["department_id", $depart],
            ["setting_id", $setting_id],
        ])->count();

        $departments = department::get();
        $course_count = $this->course_count;

        return view("hod.dashboard", ["test" => $test]);
    }
    public function hod_level_view()
    {
        $sessions = settings::where("status", "=", 1)->first();
        $session_id = $sessions->id;
        $user_id = Auth::user()->id;
        $comments = DB::table("hod_assignemnts")
            ->where("user_id", "=", $user_id)
            ->orderBy("id", "desc")
            ->first();
        $depart = $comments->department_id;
        $level = hod_assignemnt::join(
            "levels",
            "levels.department_id",
            "=",
            "hod_assignemnts.department_id"
        )
            ->where([
                ["hod_assignemnts.department_id", "=", $depart],
                ["levels.setting_id", "=", $session_id],
            ])
            ->select("levels.*")
            ->get();

        $session = $sessions->current_session;

        return view("hod.level_view", [
            "levels" => $level,
            "current_session" => $session,
        ]);
    }

    public function hod_class_view()
    {
        $sessions = settings::where("status", "=", 1)->first();
        $session_id = $sessions->id;
        $user_id = Auth::user()->id;
        $comments = DB::table("hod_assignemnts")
            ->where("user_id", "=", $user_id)
            ->orderBy("id", "desc")
            ->first();
        $depart = $comments->department_id;

        $classes = hod_assignemnt::join(
            "class_rooms",
            "class_rooms.department_id",
            "=",
            "hod_assignemnts.department_id"
        )
            ->where([
                ["hod_assignemnts.department_id", "=", $depart],
                ["class_rooms.setting_id", "=", $session_id],
            ])
            ->select("class_rooms.*")
            ->get();
        $test = course::where("department_id", $depart)->count();
        $this->course_count = $test;
        return view("hod.class_view", [
            "classes" => $classes,
            "tests" => $test,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
