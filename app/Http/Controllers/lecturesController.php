<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\course_lecture;
use App\Models\settings;
use Illuminate\Http\Request;

class lecturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("lecture.dashboard");
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
    public function show()
    {
        $setting_id = settings::where("status", "=", 1)->first()->id;
        $user_id = Auth::user()->id;
        $course = course_lecture::join(
            "courses",
            "courses.id",
            "=",
            "course_lectures.course_id"
        )
            ->where([
                ["course_lectures.user_id", "=", $user_id],
                ["courses.setting_id", "=", $setting_id],
            ])
            ->select("courses.*")
            ->get();

        return view("lecture.course_view", ["courses" => $course]);
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
