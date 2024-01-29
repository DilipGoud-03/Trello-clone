<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Stage;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use App\Models\UserInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boards = Board::where('id', $request->id)->with('stage')->first();
        $stages = $boards->stage;
        $tickets = Ticket::orderBy('stage_id', 'asc')->get();
        $user_Invites = UserInvite::where('board_id', $request->id)->get();
        $comments = TicketComment::with('ticket')->get();

        return  view('trello.board', [
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

        $board = new Board();
        $board->name = $request->boardName;
        $board->description = $request->description;
        $board->created_by = $request->created_By;
        $board->save();
        // Default stages
        // 1. Todo 
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Todo';
        $stage->sequence = '1';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_By);
        $stage->save();

        // 2. In Progress
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'In Progress';
        $stage->sequence = '2';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_By);
        $stage->save();

        // 3. Review
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Review';
        $stage->sequence = '3';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_By);
        $stage->save();

        // 4. Done
        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Done';
        $stage->sequence = '4';
        $stage->is_default = '1';
        $stage->created_by = intval($request->created_By);
        $stage->save();

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
