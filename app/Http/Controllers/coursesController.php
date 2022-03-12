<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\course_lecture;
use Illuminate\Http\Request;
use App\Models\department;
use App\Models\lecture_assignment;
use App\Models\level;
use App\Models\room;
use App\Models\semester;
use App\Models\settings;
use App\Models\studentInfo;
use App\Models\timetable;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class coursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = settings::where("status", "=", 1)->first();
        $setting_id = $setting->id;
        $course = course::where("setting_id", "=", $setting_id)->paginate(10);
        $level = level::where("setting_id", "=", $setting_id)->get();
        $depart = department::where("setting_id", "=", $setting_id)->get();
        $rooms = room::where("status", "=", 1)->get();
        $semesters = semester::get();

        return view("academic.course", [
            "depart" => $depart,
            "course" => $course,
            "levels" => $level,
            "rooms" => $rooms,
            "semesters" => $semesters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->id;
        $comments = DB::table("hod_assignemnts")
            ->where("user_id", "=", $user)
            ->orderBy("id", "desc")
            ->first();
        $depart = $comments->department_id;

        $lecture = lecture_assignment::where(
            "department_id",
            "=",
            $depart
        )->get();
        $setting_id = settings::where("status", "=", 1)->first()->id;
        $course = course::where([
            ["department_id", "=", $depart],
            ["setting_id", "=", $setting_id],
        ])->get();
        $datas = course_lecture::all();

        return view("courses.assign_lecture", [
            "lectures" => $lecture,
            "courses" => $course,
            "datas" => $datas,
        ]);
    }
    public function lecture_course_store(Request $request)
    {
        course_lecture::create([
            "user_id" => $request->user_id,
            "course_id" => $request->course_id,
        ]);
        return Redirect()
            ->back()
            ->with([
                "message" => __("msg.store_ok"),
                "alert-type" => "success",
            ]);
    }
    public function lecture_course_edit($id)
    {
        $lecture_course = course_lecture::find($id);
        $courses = course::all();
        return view("courses.edit_course", [
            "lecture_course" => $lecture_course,
            "courses" => $courses,
        ]);
    }
    public function lecture_course_update(Request $request, $id)
    {
        $da = $request->only(["user_id", "course_id"]);
        $dd = course_lecture::find($id)->update($da);

        return redirect()
            ->route("hod.create.course")
            ->with([
                "message" => __("msg.update_ok"),
                "alert-type" => "success",
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->Validate($request, [
            "course_code" => "required|max:255|unique:courses",
            "course_name" => "required",
            "course_credit" => "required|integer|between:5,25",
        ]);
        $seession = settings::where("status", "=", 1)->first();
        $setting_id = $seession->id;
        $hours_per_week = (int) ($request->course_credit / 2);
        $stored = course::create([
            "course_code" => $request->course_code,
            "course_name" => $request->course_name,
            "course_credit" => $request->course_credit,
            "hours_per_week" => $hours_per_week,
            "department_id" => $request->department_id,
            "level_id" => $request->level_id,
            "setting_id" => $setting_id,
            "semester_id" => $request->semester_id,
            "room_id" => $request->room_id,
        ]);

        return Redirect()
            ->back()
            ->with([
                "message" => __("Course Has been Created Successfull"),
                "alert-type" => "success",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth()->user()->id;
        $setting_id = settings::where("status", "=", 1)->first()->id;

        $userinfo = studentInfo::where("user_id", "=", $user)->first();
        $student_level = $userinfo->level_id;
        $student_setting = $userinfo->setting_id;
        $student_department = $userinfo->department_id;
        $student_timetable = timetable::where([
            ["department_id", "=", $student_department],
            ["level_id", "=", $student_level],
        ])->first();
        $semeste_id = $student_timetable->semester_id;
        $course = course::where([
            ["department_id", "=", $student_department],
            ["level_id", "=", $student_level],
            ["semester_id", "=", $semeste_id],
            ["setting_id", "=", $student_setting],
        ])->paginate(5);

        $show = course::where([
            ["department_id", "=", $student_department],
            ["level_id", "=", $student_level],
            ["semester_id", "=", $semeste_id],
            ["setting_id", "=", $student_setting],
        ])->first();

        return view("courses.view_course", [
            "course" => $course,
            "show" => $show,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = course::find($id);
        $settings = settings::where("status", "=", 1)->first();
        $setting_id = $settings->id;
        $depart = department::where("setting_id", "=", $setting_id)->get();
        $course = course::paginate(10);
        $level = level::where("setting_id", "=", $setting_id)->get();
        $rooms = room::where("status", "=", 1)->get();
        $semester = semester::all();

        return view("academic.course_edit", [
            "depart" => $depart,
            "course" => $course,
            "levels" => $level,
            "rooms" => $rooms,
            "infos" => $infos,
            "semesters" => $semester,
        ]);
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
        $data = $request->all();
        $update = course::find($id);
        if ($update->update($data)) {
            return redirect()
                ->route("academic.course")
                ->with([
                    "message" => __("msg.update_ok"),
                    "alert-type" => "success",
                ]);
        } else {
            return redirect()
                ->route("academic.course")
                ->with([
                    "nessage" => __("invalid update"),
                    "alert-type" => "error",
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = course::find($id)->delete();
        return redirect()
            ->route("academic.course")
            ->with([
                "alert-type" => "info",
                "message" => "The course has been deleted well",
            ]);
    }
}
