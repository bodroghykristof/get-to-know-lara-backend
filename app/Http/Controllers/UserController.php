<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        error_log('got request');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return User
     */
    public function store(Request $request)
    {
        $user = $request->all();
        $user["password"] = Hash::make($request->input('password'));
        User::create($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        //
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
