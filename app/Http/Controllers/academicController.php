<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Qs;
use App\Models\course;
use App\Models\hod_assignemnt;
use App\Models\lecture_assignment;
use App\Models\level;
use App\Models\studentInfo;
use App\Models\timetable;
use Error;
use Symfony\Component\HttpFoundation\Session\Session;

class academicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setting = settings::where("status", "=", 1)->first();

        if ($setting == null) {
            $timetable = 0;
            $department = 0;
            $course = 0;
            $hod_count = 0;
            $lecture=0;
            $students=0;
            $hours=null;
            $h=0;
        } else {
            $setting_id = $setting->id;
            $timetable = timetable::where(
                "setting_id",
                "=",
                $setting_id
            )->count();

            $department = department::where(
                "setting_id",
                "=",
                $setting_id
            )->count();
            $lecture = lecture_assignment::count();
            $students = studentInfo::where(
                "setting_id",
                "=",
                $setting_id
            )->count();
            $course = course::where("setting_id", "=", $setting_id)->count();
            $hours = course::where("setting_id", "=", $setting_id)->get();

            $hod_count = hod_assignemnt::count();
            $h = 0;
        }

        return view("academic.dashboard", [
            "department" => $department,
            "course" => $course,
            "hod_count" => $hod_count,
            "lecture" => $lecture,
            "students" => $students,
            "hours" => $hours,
            "h" => $h,
            "timetable_count" => $timetable,
        ]);
    }
    public function Search_Level(Request $request)
    {
        $parent_id = $request->depart_id;

        $courses_from_db = level::where("department_id", $parent_id)->get();
        return response()->json([
            "level" => $courses_from_db,
        ]);
    }

    /**
     * setting academic session
     *
     * @return \Illuminate\Http\Response
     */
    public function setting(Request $request)
    {
        $session = settings::where("status", "=", 0)->get();

        $datas = settings::where("status", "=", 1)->first();
        $infos = settings::all();
        if ($datas==null) {
            return view("academic.setting", [
                "datas" => $datas,
                "infos" => $infos,
            ]);
        } else {
            return view("academic.setting", [
                "datas" => $datas,
                "infos" => $infos,
            ]);
        }
    }
    public function setting_change_status(Request $request)
    {
        DB::table("settings")->update(["status" => 0]);
        $user = settings::find($request->setting_id);

        $user->status = $request->status;
        $user->save();

        return response()->json(["success" => "Status change successfully."]);
    }

    public function settingUpdate(Request $request)
    {
        $academic = settings::where(
            "current_session",
            "=",
            $request->current_session
        )->get();
        if (!$academic->isEmpty()) {
            return Redirect()
                ->back()
                ->with([
                    "message" => __("Academic Year are  Already used"),
                    "alert-type" => "error",
                ]);
        } else {
            $sets = new settings();

            $sets->system_name = $request->system_name;
            $sets->current_session = $request->current_session;
            $sets->term_begins = $request->term_begins;
            $sets->term_ends = $request->term_ends;
            $sets->save();
            return back()->with("success", __("msg.update_ok"));
        }
    }
    /** department setup */
    public function departmentIndex()
    {
        $depart = department::get();
        $setting = settings::where("status", "=", 1)->first();
        $setting_id = $setting->id;

        $department = department::where(
            "setting_id",
            "=",
            $setting_id
        )->paginate(3);
        return view("academic.department", ["department" => $department]);
    }
    public function departmentCreate(Request $request)
    {
        $abbrs = strtoupper($request->obbr);
        // $data=new department();
        // $data->abbr = $abbrs;
        // $data->description = $request->description;
        // $Name=strtoupper('it');
        $depart = department::get();
        $setting = settings::where("status", "=", 1)->first();
        $setting_id = $setting->id;

        $students = DB::table("departments")
            ->select("id", "abbr", "description", "created_at")
            ->where("abbr", "=", $abbrs)
            ->get();
        if (!$students->isEmpty()) {
            return Redirect()
                ->back()
                ->with([
                    "message" => __($abbrs . " Department is Already registed"),
                    "alert-type" => "error",
                ]);
        } else {
            $this->Validate($request, [
                "obbr" => "required|max:3",
                "description" => "required|max:255",
            ]);
            department::create([
                "abbr" => $abbrs,
                "description" => $request->description,
                "setting_id" => $setting_id,
            ]);
        }
        return redirect()
            ->route("academic.department")
            ->with([
                "alert-type" => "success",
                "message" => __($abbrs . " Department is created successfuly"),
            ]);
    }

    public function departmentDestroy($id)
    {
        $delete = department::find($id)->delete();
        return redirect()
            ->route("academic.department")
            ->with([
                "alert-type" => "success",
                "message" => "Your application Is delete",
            ]);
    }

    public function courseStore(Request $request)
    {
        // $this->validate($request, [
        //     "course_code" => "required|max:255",
        //     "course_name" => "required",
        //     "course_credit" => "required|integer|between:5,25",
        //     "department_id" => "required",
        // ]);
        return dd($request);
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
