<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo()
    {
        if (Auth()->User()->role == "academic") {
            return route("academic.dashboard");
        } elseif (Auth()->user()->role == "hod") {
            return route("hod.dashboard");
        } elseif (Auth()->user()->role == "lecture") {
            return route("lecture.dashboard");
        } elseif (Auth()->user()->role == "student") {
            return route("student.dashboard");
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required",
        ]);
        if (
            auth()->attempt([
                "email" => $input["email"],
                "password" => $input["password"],
            ])
        ) {
            if (\auth()->user()->role == "academic") {
                return redirect()
                    ->route("academic.dashboard")
                    ->with([
                        "message" => __("Welcome" . " " . auth()->user()->name),
                        "alert-type" => "success",
                    ]);
            } elseif (auth()->user()->role == "hod") {
                return redirect()
                    ->route("hod.dashboard")
                    ->with([
                        "message" => __("Welcome" . " " . auth()->user()->name),
                        "alert-type" => "success",
                    ]);
            } elseif (auth()->user()->role == "lecture") {
                return redirect()
                    ->route("lecture.dashboard")
                    ->with([
                        "message" => __("Welcome" . " " . auth()->user()->name),
                        "alert-type" => "success",
                    ]);
            } elseif (auth()->user()->role == "student") {
                return redirect()
                    ->route("student.dashboard")
                    ->with([
                        "message" => __("Welcome" . " " . auth()->user()->name),
                        "alert-type" => "success",
                    ]);
            }
        } else {
            return redirect()
                ->route("login")
                ->with([
                    "message" => "Incorrect Email or Password",
                    "alert-type" => "error",
                ]);
        }
    }
}
