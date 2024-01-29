<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'stageName' => 'required'
        ]);

        $findSequece = Stage::where('board_id', $request->board_id)->get();

        $stage = new Stage();
        $stage->board_id = $request->board_id;
        $stage->name = $request->stageName;
        $stage->sequence = count($findSequece) + 1;
        $stage->is_default = 0;
        $stage->created_by = $request->create_by;
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
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findStage = Stage::find($id);
        if ($findStage->is_default == 1) {

            return back()->with('error', 'This is default stage');
        }
        $findStage->delete();
        return back()->with('success', 'Stage Deleted');
    }
}
