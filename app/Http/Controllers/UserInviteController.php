<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\SendInvitationMail;
use Illuminate\Support\Facades\Mail;

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
        // dd($request->all());
        $request->validate(
            ['email' => 'required']
        );
        $user_id = User::where('email', $request->email)->first();
        $token = Str::random(64);
        $invite_user = new UserInvite();
        $invite_user->user_id = $user_id->id;
        $invite_user->board_id = $request->board_id;
        $invite_user->role = $request->role;
        $invite_user->invited_by = $request->invited_by;
        $invite_user->save();

        $admin = User::find($request->create_by)->first();
        $mailData = [
            'userName' => $user_id->name,
            'invited_by' => $admin->name,
            'role' => $request->role,
            'board' => $request->boardName,
            'token' => $token,
        ];
        Mail::to($request->userEmail)->send(new SendInvitationMail($mailData));

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
        dd($request->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request->id);
        $userDelete = UserInvite::find($request->id);
        if ($userDelete) {
            $userDelete->delete();
            return back();
        }
        return back();
    }
}
