<?php

namespace App\Http\Controllers;

use App\Models\days;
use App\Models\department;
use App\Models\settings;
use App\Models\timeslot;
use App\Models\timetable;
use Illuminate\Http\Request;
use App\Models\room;
use App\Models\course as course;
use App\Models\semester;
use App\Models\studentInfo;
use App\TimeTableGenerator;

class timetableController extends Controller
{
    protected $tablesss;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = timeslot::all();

        return view("timetable.timeslot", ["infos" => $infos]);
        //
    }
    public function student_timetable()
    {
        $user = Auth()->user()->id;

        $userinfo = studentInfo::where("user_id", "=", $user)->first();
        $student_level = $userinfo->level_id;
        $student_department = $userinfo->department_id;
        $student_s = $userinfo->setting_id;
        $student_timetable = timetable::where([
            ["department_id", "=", $student_department],
            ["level_id", "=", $student_level],
            ["setting_id", "=", $student_s],
        ])->first();
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", ""];

        if ($student_timetable == true) {
            $timeslots = timeslot::all();
            $schedule = json_decode($student_timetable->schedule);
            $da = days::paginate(5);
            $hours = timeslot::all();
            // dd($student_timetable);
            return view("timetable.timetable", [
                "days" => $days,
                "hours" => $hours,
                "schedules" => $schedule,
                "student_timetable" => $student_timetable,
            ]);
        } else {
            return view("timetable.timetable");
        }
    }
    public function timetable($id)
    {
        $timetable = timetable::where("id", "=", $id)->first();
        $timetable_department = $timetable->department_id;
        $timetable_level = $timetable->level_id;
        $timetable_semester = $timetable->semester_id;
        $schedule = json_decode($timetable->schedule);

        $course = course::where([
            ["department_id", "=", $timetable_department],
            ["level_id", "=", $timetable_level],
            ["semester_id", "=", $timetable_semester],
        ])->get();

        $timeslots = timeslot::all();

        $da = days::paginate(5);

        $hours = timeslot::all();
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", ""];

        return view("timetable.timetable", [
            "days" => $days,
            "hours" => $hours,
            "schedules" => $schedule,
            "timetable" => $timetable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, TimeTable $table)
    {
        $condition = $request->except("_token");
        if (!isset($condition["department_id"])) {
            $condition["department_id"] != 0;
        }
        $courses = course::where([
            ["department_id", "=", $request->department_id],
            ["level_id", "=", $request->level_id],
            ["semester_id", "=", $request->semester_id],
        ])
            ->get()
            ->toArray();

        $levelWideCourses = null;
        $newCondition = $condition;
        $newCondition["department_id"] != 0;
        if ($table->alreadyHas($newCondition)) {
            $levelWideCourses = $table->where($newCondition)->first()->schedule;
        }

        try {
            $timeTable = new TimeTableGenerator($courses);
            $timeTable->levelWideCourse(json_decode($levelWideCourses, true));

            $timeTable = $timeTable->generate($request->department_id);

            if ($table->alreadyHas($condition)) {
                $table
                    ->where($condition)
                    ->update(["schedule" => json_encode($timeTable)]);
            } else {
                $settion = settings::where("status", "=", 1)->first();
                $setting_id = $settion->id;
                $tablesss = timetable::create([
                    "timetable_name" => $request->timetable_name,
                    "department_id" => $request->department_id,
                    "level_id" => $request->level_id,
                    "semester_id" => $request->semester_id,
                    "setting_id" => $setting_id,
                    "schedule" => json_encode($timeTable),
                ]);
            }
            return redirect()
                ->back()
                ->with([
                    "message" => __("timetable Created"),
                    "alert-type" => "success",
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("error", $e->getMessage());
        }
    }
    public function create_timetable()
    {
        $settings = settings::where("status", "=", 1)->first();

        $setting_id = $settings->id;
        $departs = department::where("setting_id", "=", $setting_id)->get();
        $displays = timetable::where("setting_id", "=", $setting_id)->get();
        $semesters = semester::all();
        return view("academic.modal", [
            "departs" => $departs,
            "displays" => $displays,
            "semesters" => $semesters,
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
        $rules = [
            "from" => "required|before:to",
            "to" => "required|after:from",
        ];

        $messages = [
            "from.before" => "From time must be before To time",
            "to.after" => "To time must be after From time",
        ];

        $this->validate($request, $rules, $messages);
        $from = timeslot::where("from", "=", $request->from)->first();
        $to = timeslot::where("to", "=", $request->to)->first();
        $data_from = $request->from;
        $data_to = $request->to;

        if ($from || $to) {
            return redirect()
                ->back()
                ->with([
                    "message" => __("Data has been saved"),
                    "alert-type" => "error",
                ]);
        } else {
            $store = timeslot::create([
                "from" => $request->from,
                "to" => $request->to,
            ]);
        }

        if ($store = true) {
            return redirect()
                ->back()
                ->with([
                    "message" => __("msg.store_ok"),
                    "alert-type" => "success",
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    "message" => __("Data couldn't be saved"),
                    "alert-type" => "error",
                ]);
        }
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
        $delete = timeslot::find($id)->delete();
        return redirect()
            ->route("academic.timeslot")
            ->with([
                "alert-type" => "info",
                "message" => "Your application Is delete",
            ]);
    }
    public function destroy_timetable($id)
    {
        $delete = timetable::find($id)->delete();
        if ($delete = true) {
            return redirect()
                ->route("academic.newtimetable")
                ->with([
                    "alert-type" => "info",
                    "message" => "Your timetable has been deleted successfuly",
                ]);
        } else {
            return redirect()
                ->route("academic.newtimetable")
                ->with([
                    "alert-type" => "error",
                    "message" => "you attempt to delet is denied",
                ]);
        }
    }
}
