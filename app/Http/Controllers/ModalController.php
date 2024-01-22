<?php

namespace App\Http\Controllers;

use App\Mail\SendInvitationMail;
use App\Models\Board;
use App\Models\Stage;
use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ModalController extends Controller
{
    function modalData(Request $request)
    {
        $request->validate([
            'boardName' => 'required',
            'userEmail' => 'required'

        ]);

        $board = new Board();
        $board->name = $request->boardName;
        $board->description = $request->boardDescription;
        $board->created_by = intval($request->created_by);
        $board->save();

        $findUserId = User::where('email', $request->userEmail)->first();

        if (is_null($findUserId)) {
            return back()->with('error', 'Invalid invited user email');
        }

        $token = Str::random(64);
        $user_invite = new UserInvite();
        $user_invite->user_id = $findUserId->id;
        $user_invite->board_id = $board->id;
        $user_invite->role = $request->role;
        $user_invite->token = $token;
        $user_invite->invited_by = intval($request->created_by);
        $user_invite->save();

        $mailData = [
            'name' => $findUserId->name,
            'invited_by' => Auth::user()->name,
            'role' => $request->role,
            'board' => $request->boardName,
            'token' => $token,
        ];
        Mail::to($request->userEmail)->send(new SendInvitationMail($mailData));

        // Default stages
        // 1. Todo 
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Todo';
        $stage->sequence = '1';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_by);
        $stage->save();

        // 2. In Progress
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'In Progress';
        $stage->sequence = '2';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_by);
        $stage->save();

        // 3. Review
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Review';
        $stage->sequence = '3';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_by);
        $stage->save();

        // 4. Done
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Done';
        $stage->sequence = '4';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_by);
        $stage->save();

        // 5. Custom stages
        $stageSequence = Stage::where('board_id', $board->id)->get();
        if (!empty($request->stageName)) {
            $stage = new Stage();
            $stage->board_id = $board->id;
            $stage->name = $request->stageName;
            $stage->sequence = count($stageSequence) + 1;
            $stage->is_default = '0';
            $stage->created_by = intval($request->created_by);
            $stage->save();
        }
        return back();
    }
}
