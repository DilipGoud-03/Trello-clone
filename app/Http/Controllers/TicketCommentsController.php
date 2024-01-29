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
        $request->validate([
            'comment' => 'required'
        ]);
        $comment = new TicketComment();
        $comment->created_by = Auth::user()->id;
        $comment->tickets_id = $request->tickets_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json(
            [
                'success' => 'comment created successfully',
                'alert-type' => 'success'
            ]

        );
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
    public function destroy(Request $request)
    {
        $deleteComment = TicketComment::find($request->id);
        if (Auth::user()->id == $deleteComment->created_by) {
            $deleteComment->delete();
            return response()->json([
                'success' => "comment deleted",
                'alert-type' => 'success'
            ]);
        }
        return response()->json([
            'error' => "You can't delete this comment",
            'alert-type' => 'error'
        ]);
    }
}
