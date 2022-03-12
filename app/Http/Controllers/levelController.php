<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\level;
use App\Models\settings;
use Illuminate\Http\Request;

class levelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = settings::where("status", "=", 1)->first();
        $setting_id = $sessions->id;
        $levels = level::where("setting_id", "=", $setting_id)->get();
        $departs = department::where("setting_id", "=", $setting_id)->get();

        $session = $sessions->current_session;

        return view("level.index", [
            "departs" => $departs,
            "session" => $session,
            "levels" => $levels,
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
        $setting = settings::where("status", "=", 1)->first();
        $stored = $setting->current_session;
        if ($stored == $request->current_session) {
            level::create([
                "level_name" => $request->level_name,
                "department_id" => $request->depart,
                "setting_id" => $setting->id,
            ]);
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
        $levels_edit = level::find($id);
        $departments = department::all();

        return view("level.edit", [
            "levels_edit" => $levels_edit,
            "department" => $departments,
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
        $data = $request->only(["level_name", "department_id"]);
        level::find($id)->update($data);
        return redirect()
            ->route("academic.level")
            ->with([
                "message" => __("msg.update_ok"),
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
        $delete = level::find($id)->delete();
        return redirect()
            ->route("academic.level")
            ->with([
                "alert-type" => "success",
                "message" => "Your Level has been deleted successfuly",
            ]);
    }
}
