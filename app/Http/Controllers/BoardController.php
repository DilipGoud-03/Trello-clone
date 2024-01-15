<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Stage;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boards = Board::where('id', $request->id)->first();
        $stages = Stage::where('board_id', $boards->id)->get();
        // dd($stages);
        // dd($stages->id);
        // $tickets = Ticket::where('stage_id', $stages->id)->get();
        return view('trello.board', [
            'boards' => $boards,
            'stages' => $stages,
            // 'tickets' => $tickets
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
