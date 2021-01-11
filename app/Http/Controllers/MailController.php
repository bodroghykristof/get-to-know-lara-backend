<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
     * @return JsonResponse
     */
    public function inbox()
    {
        $userId = auth()->user()->id;
        return response()->json(DB::table('mails')
            ->join('users', 'users.id', '=', 'mails.id_user_from')
            ->where("id_user_to", $userId)
            ->orderByDesc('sent')
            ->select('mails.*', 'users.name as partner', 'users.email as partner_email')
            ->get(), 200);
    }

    /**
     * Display a mails sent by a given user.
     *
     * @param Request $request
     * @param int $userId
     * @return Collection
     */
    public function sent(Request $request)
    {
        $indexOfRelevantSegment = 3;
        $isDraft = $request->segment($indexOfRelevantSegment) === 'drafts';
        $allSentMessages = DB::table('mails')
            ->join('users', 'users.id', '=', 'mails.id_user_to')
            ->where("id_user_from", 5)
            ->orderByDesc('sent')
            ->select('mails.*', 'users.name as partner', 'users.email as partner_email');
        if (!$isDraft) return $allSentMessages->whereNotNull('sent')->get();
        else return $allSentMessages->whereNull('sent')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Mail
     */
    public function store(Request $request)
    {
        $mail = $request->all();
        if ($request->input('finished')) $mail["sent"] = now();
        Mail::create($mail);
    }

    /**
     * Display the specified resource.
     *
     * @param Mail $mail
     * @return Mail|Mail[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Response
     */
    public function show(Mail $mail)
    {
        return Mail::find($mail->id);
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
        $mailModification = $request->except("finished");
        $mail = Mail::where('id', $mail->id);
        if ($request->input('finished')) $mailModification["sent"] = now();
        $mail->update($mailModification);
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
