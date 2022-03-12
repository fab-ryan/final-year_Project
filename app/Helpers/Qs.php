<?php

use App\Models\department;
use App\Models\settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\lecture_assignment;
use App\Models\hod_assignemnt;
use App\Models\studentInfo;

class Qs
{
    public static function userIsAcademic()
    {
        return Auth::user()->role == "academic";
    }
    public static function userIsStudent()
    {
        return Auth::user()->role == "student";
    }
    public static function userIsLecture()
    {
        return Auth::user()->role == "lecture";
    }
    public static function userIsHod()
    {
        return Auth::user()->role == "hod";
    }

    public static function Check_UserDepartment()
    {
        if (Auth::user()->role == "lecture") {
            $user_id = Auth::user()->id;
            $de = lecture_assignment::where("user_id", "=", $user_id)->first();
            $department = $de->department->abbr;
            return $department;
        } elseif (Auth::user()->role == "hod") {
            $user_id = Auth::user()->id;
            $de = hod_assignemnt::where("user_id", "=", $user_id)->first();
            $department = $de->department->abbr;
            return $department;
        } elseif (Auth::user()->role == "student") {
            $user_id = Auth::user()->id;

            $de = studentInfo::where("user_id", "=", $user_id)->first();
            $department = $de->department->abbr;
            return $department ? $department :'';
        }
    }
    public static function Save_department_Id()
    {
        $user_id = Auth::user()->id;
        $de = hod_assignemnt::where("user_id", "=", $user_id)->first();
        $department_id = $de->department->id;
        return $department_id;
    }
    public function Search_Hod(Request $request)
    {
        $parent_id = $request->department_id;

        $department_hod = hod_assignemnt::where(
            "department_id",
            $parent_id
        )->get();
        $user = $department_hod->user->name;

        return $this->$user;
    }

    public static function applicationName()
    {
        # code...
        return "Academic Teaching Timetable System";
    }
    public static function getSetting($type)
    {
        $current = settings::where("id", $type)->first();
    }
    public static function getPanelOptions()
    {
        return '    <div class="header-elements">
                <div class="list-icons">

                </div>
            </div>';
    }
    public static function json($msg, $ok = true, $arr = [])
    {
        return $arr
            ? response()->json($arr)
            : response()->json(["ok" => $ok, "msg" => $msg]);
    }

    public static function jsonStoreOk()
    {
        return self::json(__("msg.store_ok"));
    }
}
