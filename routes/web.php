<?php

use App\Http\Controllers\hodController;
use App\Http\Controllers\lecturesController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\roomsController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\academicMiddleware;
use App\Http\Middleware\lecturesMiddleware;

use App\Http\Controllers\academicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\classroomController;
use App\Http\Controllers\levelController;
use App\Http\Controllers\RegisterNewUserController;
use App\Http\Controllers\timetableController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view("auth.login");
});

/*************** Academic Router and Middleware *****************/
Route::group(
    ["prefix" => "academic", "middleware" => ["academic", "auth"]],
    function () {
        Route::get("dashboard", [academicController::class, "index"])->name(
            "academic.dashboard"
        );
        Route::get("{id}/user/edit", [
            RegisterNewUserController::class,
            "edit_user",
        ])->name("academic.user.edit");
        Route::post("{id}/user/update", [
            RegisterNewUserController::class,
            "update",
        ])->name("academic.user.update");

        /********** setting Route */
        Route::get("setting", [academicController::class, "setting"])->name(
            "academic.setting"
        );
        Route::post("settingUpdate", [
            academicController::class,
            "settingUpdate",
        ])->name("academic.settingUpdate");
        Route::get("setting/status", [
            academicController::class,
            "setting_change_status",
        ])->name("academic.change.status.setting");

        /********** Level Route */
        Route::get("level", [levelController::class, "index"])->name(
            "academic.level"
        );
        Route::post("level/create", [levelController::class, "store"])->name(
            "academic.level.create"
        );
        Route::delete("{id}/level/destroy", [
            levelController::class,
            "destroy",
        ])->name("academic.destroy.level");
        Route::get("{id}/level/edit", [levelController::class, "edit"])->name(
            "academic.level.edit"
        );
        Route::post("{id}/level/update", [
            levelController::class,
            "update",
        ])->name("academic.level.update");
        Route::post("alevel/search", [
            academicController::class,
            "Search_level",
        ])->name("academic.search.level");
        /********** Department Route */

        Route::get("department", [
            academicController::class,
            "departmentIndex",
        ])->name("academic.department");
        Route::post("department/create", [
            academicController::class,
            "departmentCreate",
        ])->name("academic.create.department");

        Route::delete("{id}/department/destroy", [
            academicController::class,
            "departmentDestroy",
        ])->name("academic.destroy.department");

        Route::get("course", [coursesController::class, "index"])->name(
            "academic.course"
        );
        /********** room Route */

        Route::get("academic/room", [roomsController::class, "index"])->name(
            "academic.rooms"
        );
        Route::post("academic/room/create", [
            roomsController::class,
            "store",
        ])->name("academic.rooms.create");
        Route::get("status/change", [
            roomsController::class,
            "ChangeStatus",
        ])->name("academic.change.status");
        Route::post("course/create", [coursesController::class, "store"])->name(
            "academic.create.course"
        );
        Route::get("{id}/course/edit", [
            coursesController::class,
            "edit",
        ])->name("academic.course.edit");
        Route::post("{id}/course/delete", [
            coursesController::class,
            "destroy",
        ])->name("academic.destroy.course");
        Route::post("{id}/course/update", [
            coursesController::class,
            "update",
        ])->name("academic.course.update");

        /********************* Class Room Router *****************************/
        Route::get("classRoom", [classroomController::class, "index"])->name(
            "academic.classRoom"
        );
        Route::post("SearchCourses", [
            classroomController::class,
            "searchCourses",
        ])->name("academic.searchCourses");
        Route::post("classRoom", [classroomController::class, "store"])->name(
            "academic.classRoom.create"
        );
        /********************HOD and Lectures ***************************/
        Route::get("hod", [
            RegisterNewUserController::class,
            "hod_register",
        ])->name("academic.hod");
        Route::post("host/create", [
            RegisterNewUserController::class,
            "hod_store",
        ])->name("academic.hod.create");
        Route::get("lecture", [
            RegisterNewUserController::class,
            "lecture_register",
        ])->name("academic.lecture");
        Route::post("academic/hod/lecture", [
            RegisterNewUserController::class,
            "Search_Hod",
        ])->name("academic.Search_Hod");
        Route::post("lecture/store", [
            RegisterNewUserController::class,
            "lecture_store",
        ])->name("academic.lecture.store");
        /********************Time Table ***************************/
        Route::get("timeslot", [timetableController::class, "index"])->name(
            "academic.timeslot"
        );
        Route::post("timeslot/store", [
            timetableController::class,
            "store",
        ])->name("academic.timeslot.store");
        Route::post("{id}/timeslot/delete", [
            timetableController::class,
            "destroy",
        ])->name("academic.timeslot.destroy");
        Route::get("{id}/timetable", [
            timetableController::class,
            "timetable",
        ])->name("academic.timetable");
        Route::post("timetable/create", [
            timetableController::class,
            "create",
        ])->name("academic.timetable.create.new");
        Route::get("academic/timetable/new", [
            timetableController::class,
            "create_timetable",
        ])->name("academic.newtimetable");
        Route::post("{id}/academic/timetable/delete", [
            timetableController::class,
            "destroy_timetable",
        ])->name("academic.timetable.destroy");
    }
);

/*************** HOD Router and Middleware *****************/
Route::group(["prefix" => "hod", "middleware" => ["hod", "auth"]], function () {
    Route::get("dashboard", [hodController::class, "index"])->name(
        "hod.dashboard"
    );
    Route::get("{id}/user/edit", [
        RegisterNewUserController::class,
        "edit_user",
    ])->name("hod.user.edit");
    Route::post("{id}/user/update", [
        RegisterNewUserController::class,
        "update",
    ])->name("hod.user.update");
    Route::get("level", [hodController::class, "hod_level_view"])->name(
        "hod.level"
    );
    Route::get("class", [hodController::class, "hod_class_view"])->name(
        "hod.class"
    );
    Route::get("lecture/course", [coursesController::class, "create"])->name(
        "hod.create.course"
    );
    Route::post("lecture/course/store", [
        coursesController::class,
        "lecture_course_store",
    ])->name("hod.lecture_course.store");

    Route::get("{id}/course/edit", [
        coursesController::class,
        "lecture_course_edit",
    ])->name("hod.lecture.course.edit");

    Route::post("{id}/course/lecture/update", [
        coursesController::class,
        "lecture_course_update",
    ])->name("hod.lecture_course.update");
    Route::get("student", [studentController::class, "NewStudent"])->name(
        "hod.student"
    );
    Route::post("student/create", [studentController::class, "store"])->name(
        "hod.student.store"
    );
    Route::get("lecture", [
        RegisterNewUserController::class,
        "lecture_register",
    ])->name("hod.lecture");
    Route::post("hod/hod/lecture", [
        RegisterNewUserController::class,
        "Search_Hod",
    ])->name("hod.Search_Hod");
    Route::post("lecture/store", [
        RegisterNewUserController::class,
        "lecture_store",
    ])->name("hod.lecture.store");
    Route::get("timetable", [
        timetableController::class,
        "create_timetable",
    ])->name("hod.timetable");
    Route::get("{id}/timetable", [
        timetableController::class,
        "timetable",
    ])->name("hod.view.timetable");
});

/*************** lecture Router and Middleware *****************/
Route::group(
    ["prefix" => "lecture", "middleware" => ["lecture", "auth"]],
    function () {
        Route::get("dashboard", [lecturesController::class, "index"])->name(
            "lecture.dashboard"
        );
        Route::get("{id}/user/edit", [
            LoginController::class,
            "edit_user",
        ])->name("lecture.user.edit");
        Route::post("{id}/user/update", [
            RegisterNewUserController::class,
            "update",
        ])->name("lecture.user.update");
        Route::get("lecture", [lecturesController::class, "show"])->name(
            "lecture.show"
        );
        Route::get("student", [studentController::class, "NewStudent"])->name(
            "lecture.student"
        );
        Route::post("student/create", [
            studentController::class,
            "store",
        ])->name("lecture.student.store");
        Route::get("timetable", [
            timetableController::class,
            "create_timetable",
        ])->name("lecture.timetable");
        Route::get("{id}/timetable", [
            timetableController::class,
            "timetable",
        ])->name("lecture.view.timetable");
    }
);

/*************** student Router and Middleware *****************/
Route::group(
    ["prefix" => "student", "middleware" => ["student", "auth"]],
    function () {
        Route::get("dashboard", [studentController::class, "index"])->name(
            "student.dashboard"
        );
        Route::get("{id}/user/edit", [
            LoginController::class,
            "edit_user",
        ])->name("student.user.edit");
        Route::post("{id}/user/update", [
            RegisterNewUserController::class,
            "update",
        ])->name("student.user.update");
        Route::get("timetable", [
            timetableController::class,
            "student_timetable",
        ])->name("student.timetable");
        Route::get("courses", [coursesController::class, "show"])->name(
            "student.course"
        );
    }
);

Auth::routes();
