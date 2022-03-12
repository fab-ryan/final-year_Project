<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class roomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = room::get();
        $departm = department::get();
        return view("rooms.index", [
            "rooms" => $rooms,
            "departments" => $departm,
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
    public function ChangeStatus(Request $request)
    {
        $user = room::find($request->room_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(["success" => "Status change successfully."]);
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
            "lab_class" => "required",
            "room" => "required|max:150",
            "description" => "required|max:255",
        ]);
        $stored = room::create([
            "lab_class" => $request->lab_class,
            "room" => $request->room,
            "description" => $request->description,
            "status" => $request->status,
            "department_id" => $request->department_id,
        ]);
        return Redirect()
            ->back()
            ->with([
                "message" => __(" room msg.store_ok"),
                "alert_type" => "success",
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
