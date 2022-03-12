<?php

namespace App\Http\Controllers;

use App\Models\classRoom;
use App\Models\hod_assignemnt;
use Illuminate\Http\Request;
use App\Models\lecture_assignment;
use App\Models\level;
use App\Models\settings;
use App\Models\studentInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Qs;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("student.dashboard");
    }
    public function NewStudent()
    {
        $setting_id = settings::where("status", "=", 1)->first()->id;
        $user_id = Auth::user()->id;
        if (Qs::userIsLecture()) {
            $de = lecture_assignment::where("user_id", "=", $user_id)->first();
        }
        if (Qs::userIsHod()) {
            $de = hod_assignemnt::where("user_id", "=", $user_id)->first();
        }
        $department_id = $de->department->id;
        $level = level::where([
            ["department_id", "=", $department_id],
            ["setting_id", "=", $setting_id],
        ])->get();
        $className = classRoom::where([
            ["department_id", "=", $department_id],
            ["setting_id", "=", $setting_id],
        ])->get();
        $student_Infos = studentInfo::where(
            "department_id",
            "=",
            $department_id
        )->get();

        return view("student.NewStudent", [
            "levels" => $level,
            "className" => $className,
            "student_infos" => $student_Infos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:users",
            ],
            "phone_number" => ["required", new PhoneNumber()],

            "password" => ["required", "string", "min:8"],
        ]);
        $settings = settings::where("status", "=", 1)->first()->id;

        try {
            $new_hod = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "role" => "student",
                "password" => Hash::make($request->password),
            ]);
            $assing = studentInfo::create([
                "user_id" => $new_hod->id,
                "regno" => $request->regno,
                "phone_number" => $request->phone_number,

                "department_id" => $request->department_id,
                "level_id" => $request->level_id,
                "class_rooms_id" => $request->classroom_id,
                "setting_id" => $settings,
            ]);
            return Redirect()
                ->back()
                ->with([
                    "message" => __("msg.store_ok"),
                    "alert-type" => "success",
                ]);
        } catch (\Exception $ex) {
            return redirect()
                ->back()
                ->with([
                    "message" => __("The User Email Has been taken"),
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
        //
    }
}
