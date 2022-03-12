<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\hod_assignemnt;
use App\Models\lecture_assignment;
use App\Models\level;
use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Qs;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegisterNewUserController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $request)
    {
        return Validator::make($request, [
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:users",
            ],
            "password" => ["required", "string", "min:8", "confirmed"],
        ]);
    }

    public function hod_register(Request $request)
    {
        $sessions = settings::where("status", "=", 1)->first();
        $setting_id = $sessions->id;

        $departments = department::where("setting_id", "=", $setting_id)->get();
        $displays = hod_assignemnt::all();
        return view("hod.index", [
            "departments" => $departments,
            "displays" => $displays,
        ]);
    }
    public function hod_store(Request $request)
    {
        try {
            $new_hod = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "role" => "hod",
                "password" => Hash::make($request->password),
            ]);
            $assing = hod_assignemnt::create([
                "user_id" => $new_hod->id,
                "department_id" => $request->department_id,
            ]);
            return Redirect()
                ->back()
                ->with([
                    "message" => __("msg.store_ok"),
                    "alert-type" => "success",
                ]);
        } catch (Exception $ex) {
            return redirect()
                ->back()
                ->with([
                    "message" => __("The User Email Has been taken"),
                    "alert-type" => "error",
                ]);
        }
    }
    public function lecture_register()
    {
        $departments = department::all();
        $displays = lecture_assignment::all();

        $user = Auth::user()->id;

        $comments = DB::table("hod_assignemnts")
            ->where("user_id", "=", $user)
            ->first();
        if ($comments) {
            $departss = $comments->department_id;
            $depart = department::where("id", "=", $departss)->first();
            $levels = level::where("department_id", "=", $departss)->get();

            if (Qs::userIsHod()) {
                $lectures = lecture_assignment::where(
                    "department_id",
                    "=",
                    $departss
                )->get();
                $levels = level::where("department_id", "=", $departss)->get();

                return view("lecture.index", [
                    "depart" => $depart,
                    "lectures" => $lectures,
                    "levels" => $levels,
                ]);
            }
        } else {
            return view("lecture.index", [
                "departments" => $departments,
                "displays" => $displays,
            ]);
        }
    }

    public function lecture_store(Request $request)
    {
        try {
            $new_lecture = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "role" => "lecture",
                "password" => Hash::make($request->password),
            ]);
            $assinng = lecture_assignment::create([
                "user_id" => $new_lecture->id,
                "level_id" => $request->level_id,
                "department_id" => $request->department,
            ]);
            return Redirect()
                ->back()
                ->with([
                    "message" => __("msg.store_ok"),
                    "alert-type" => "success",
                ]);
        } catch (Exception $ex) {
            return Redirect()
                ->back()
                ->with([
                    "message" => __($ex->getMessage()),
                    "alert-type" => "error",
                ]);
        }
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
        $request->validate([
            "name" => ["required", "string", "max:255"],

            "password" => ["required", "string", "min:8", "confirmed"],
        ]);
        $user_update = User::findOrFail($id);

        if ($user_update) {
            $user_update->name = $request->name;
            $user_update->password = Hash::make($request->password);
            $user_update->save();
        }
        return Redirect()
            ->back()
            ->with([
                "message" => __("User has changed profile successfuly"),
                "alert-type" => "success",
            ]);
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
    public function edit_user($id, Request $request)
    {
        $user_id = Auth::user()->id;
        $user_infos = User::find($user_id);
        return view("auth.edit", ["user_info" => $user_infos]);
    }
}
