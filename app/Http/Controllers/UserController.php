<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return User::get(["id", "name"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return User
     */
    public function register(Request $request)
    {
        $user = $request->all();
        $user["password"] = Hash::make($request->input('password'));
        User::create($user);
    }

    /**
     * Login the user into the system
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->firstOr(function () {
            error_log('wrong email');
            return null;
        });

        if (Auth::attempt($request->all())) {
            error_log(Auth::id());
            $request->session()->regenerate();
            error_log('OOOK');
        } else {
            error_log('wrong pasword');}
    }
}
