<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function post_order_change(Request $request)
    {
        $data = $request->input('order');
        foreach ($data as $index => $id) {
            Stage::where('id', $id)->update(['position' => $index]);
        }
        return back()->with('success', 'stage order change successfully');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stageName' => 'required'
        ]);

        $findSequence = Stage::where('board_id', $request->board_id)->get();

        $stage = new Stage();
        $stage->board_id = $request->board_id;
        $stage->name = $request->stageName;
        $stage->sequence = count($findSequence) + 1;
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
    public function stage_order_change(Request $request)
    {
        $data = $request->input('order');
        foreach ($data as $index => $id) {
            Stage::where('id', $id)->update(['sequence' => $index]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $findStage = Stage::find($id);
        if ($findStage->is_default == 1) {

            return back()->with('error', 'Default stage Can not be deleted');
        }
        $findStage->delete();
        return back()->with('success', 'Stage Deleted');
    }
}
