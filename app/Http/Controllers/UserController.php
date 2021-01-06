<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

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

        $password = $request->input('password');
        if (Hash::check($password, $user->password)) {
            error_log('OOOK');
        } else {
            error_log('wrong pasword');}
    }
}
