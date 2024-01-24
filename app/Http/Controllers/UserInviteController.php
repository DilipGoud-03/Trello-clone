<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\SendInvitationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UserInviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['email' => 'required']
        );
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return back()->with('error', ' Email address does not exist');
        }

        $token = Str::random(64);
        $user_invite = new UserInvite();
        $user_invite->user_id = $user->id;
        $user_invite->board_id = $request->board_id;
        $user_invite->role = $request->role;
        $user_invite->token = $token;
        $user_invite->invited_by = Auth::user()->id;
        $user_invite->save();

        $mailData = [
            'name' => $user->name,
            'invited_by' => Auth::user()->name,
            'role' => $request->role,
            'board' => $request->boardName,
            'token' => $token,
        ];
        Mail::to($request->email)->send(new SendInvitationMail($mailData));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $userDelete = UserInvite::find($request->id);
        if ($userDelete) {
            $userDelete->delete();
            return back();
        }
        return back();
    }

    /**
     * Invitation Accept .
     */
    public function userAcceptInvitation($token)
    {
        $verifyUser = UserInvite::where('token', $token)->first();
        $message = 'Your Invitation has been deleted.';
        if (!is_null($verifyUser)) {
            UserInvite::where('token', $token)->update([
                'status' => 'Accepted',
                'token' => 'verify'
            ]);
            $message = 'You Accept Invitation';
        }
        return redirect()->route('login')->with('message', $message);
    }
    /**
     * Invitation Reject.
     */
    public function userRejectInvitation($token)
    {
        $verifyUser = UserInvite::where('token', $token)->first();
        $message = 'Your Invitation has been deleted.';
        if (!is_null($verifyUser)) {
            UserInvite::where('token', $token)->update([
                'status' => 'Rejected',
                'token' => 'verify'
            ]);
            $message = 'You Reject Invitation';
        }

        return redirect()->route('login')->with('message', $message);
    }
}
