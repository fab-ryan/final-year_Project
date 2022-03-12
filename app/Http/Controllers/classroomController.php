<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use App\Models\course;
use App\Models\department;
use App\Models\room;
use App\Models\settings;
use Illuminate\Http\Request;

class classroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting_id = settings::where("status", "=", 1)->first()->id;

        $departs = department::where("setting_id", $setting_id)->get();
        $room = room::all();

        $p = $request->depart;
        $classRoom = classRoom::where("setting_id", $setting_id)->get();
        // dd($classRoom);
        return view("classRoom.index", [
            "departs" => $departs,
            "classRoom" => $classRoom,
        ]);
    }
    public function searchCourses(Request $request)
    {
        $parent_id = $request->depart_id;
        $setting_id = settings::where("status", "=", 1)->first()->id;

        $courses_from_db = course::where([
            ["department_id", $parent_id],
            ["setting_id", $setting_id],
        ])->get();
        return response()->json([
            "courses" => $courses_from_db,
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
        $setting_id = settings::where("status", "=", 1)->first()->id;
        $stored = classRoom::create([
            "class_name" => $request->class_name,
            "department_id" => $request->department_id,
            "course_id" => $request->course_id,
            "setting_id" => $setting_id,
        ]);

        return Redirect()
            ->back()
            ->with([
                "message" => __("msg.store_ok"),
                "alert-type" => "success",
            ]);
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
