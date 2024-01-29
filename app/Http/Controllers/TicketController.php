<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $assignee = User::where('email', $request->assinee)->first();
        $request->validate([
            'ticketsName' => 'required',
        ]);
        $ticket = new Ticket();
        $ticket->stage_id = $request->stage_id;
        $ticket->assignee = $assignee->id;
        $ticket->name = $request->ticketsName;
        $ticket->description = $request->decription;
        $ticket->created_by = $request->created_by;
        $ticket->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tickets = Ticket::find($request->id)->first();
        // dd($tickets);
        return view('trello.ticketsDetails', ['tickets' => $tickets]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleteTickets = Ticket::find($request->id);
        $deleteTickets->delete();
        return back();
    }
}
