<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        error_log("Got it");
    }

    /**
     * Display a mails in user's inbox.
     *
     * @param int $userId
     * @return void
     */
    public function inbox(int $userId)
    {
        return Mail::where("id_user_to", $userId)
            ->orderByDesc('sent')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Mail
     */
    public function store(Request $request)
    {
        return Mail::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Mail $mail
     * @return Response
     */
    public function show(Mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Mail $mail
     * @return Response
     */
    public function update(Request $request, Mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mail $mail
     * @return Response
     */
    public function destroy(Mail $mail)
    {
        //
    }
}
