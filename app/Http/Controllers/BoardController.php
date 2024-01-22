<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boards = Board::where('id', $request->id)->with('stage', 'userInvite')->first();
        $stages = $boards->stage;
        $tickets = Ticket::with('stage')->get();
        $user_Invites =  DB::table('users')
            ->select('users.name', 'user_invites.id', 'user_invites.role', 'user_invites.status', 'user_invites.invited_by')
            ->join('user_invites', 'user_invites.user_id', '=', 'users.id')
            ->where('user_invites.board_id', $request->id)
            ->get();
        $comments = TicketComment::with('ticket')->get();
        return view('trello.board', [
            'boards' => $boards,
            'stages' => $stages,
            'tickets' => $tickets,
            'user_Invites' => $user_Invites,
            'comments' => $comments
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $board = Board::find($request->id);
        if ($board) {
            $board->delete();
            return back()->with('success', 'Board Deleted');
        }
        return back()->with('error', 'Board does not Deleted');
    }
}
