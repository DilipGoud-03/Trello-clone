<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Stage;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    function modalData(Request $request)
    {
        $board = new Board();
        $board->name = $request->boardName;
        $board->description = $request->baordDescription;
        $board->created_by = $request->id;
        $board->save();

        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Todo';
        $stage->sequence = '1';
        $stage->is_default = '1';
        $stage->created_by = $request->id;
        $stage->save();

        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'In Progress';
        $stage->sequence = '2';
        $stage->is_default = '1';
        $stage->created_by = $request->id;
        $stage->save();

        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Review';
        $stage->sequence = '3';
        $stage->is_default = '1';
        $stage->created_by = $request->id;
        $stage->save();

        $stage = new Stage();
        $stage->board_id = $board->id;
        $stage->name = 'Done';
        $stage->sequence = '4';
        $stage->is_default = '1';
        $stage->created_by = $request->id;
        $stage->save();
    }
}
