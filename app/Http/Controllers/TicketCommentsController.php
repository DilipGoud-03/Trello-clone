<?php

namespace App\Http\Controllers;

use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class TicketCommentsController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new TicketComment();
        $comment->created_by = $request->created_by;
        $comment->tickets_id = $request->tickets_id;
        $comment->comment = $request->comment;
        $comment->save();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteComment = TicketComment::find($id)->first();
        if (Auth::user()->id == $deleteComment->created_by) {
            $deleteComment->delete();
            return back()->with('success', "comment deleted");
        }
        return back()->with('error', "You can't delete this comment");
    }
}
