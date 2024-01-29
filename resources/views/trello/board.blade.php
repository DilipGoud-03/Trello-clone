@extends('layouts.auth')
@section('content')
@include('trello.modals.createBoard')
@include('trello.modals.ticketsDetails')
<div class="row justify-content-center mt-1">
    <div class="col-md-8" style="width: auto">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn">{{$boards->name}}</a>
                <a href="" class="btn" style="margin-left: 100px">Invite User</a>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createBoardModel" style="float: inline-end;margin-right: 41px;">Create Board</button>
            </div>
            <div class="card-body" style="width: 100%;overflow-x: auto;">
                <table class="table" style="width: max-content;">
                    <thead>
                        @foreach($stages as $stage)
                        <th style="border-bottom-width: inherit">
                            <div class="col-md-8" style="width: auto">
                                <div class="card" style="width: auto">
                                    <div class=" card-header">
                                        <p>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#createTickestModel" data-id="{{$stage->id}}" title="create new tickets" style="color: blue;">ADD</a>
                                            <a href="{{route('stageDelete',['id'=>$stage->id])}}" class="btn" style="margin: -76px -14px -65px 182px;color: red;" title="Delete Stage">X</a>
                                        </p>
                                        <p style="text-align: center;margin: auto;">
                                            {{$stage->name}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </th>
                        @endforeach
                        <th style="border-bottom-width: inherit">
                            <div class="col-md-8" style="width: auto">
                                <div class="card" style="width: auto">
                                    <div class="card-header">
                                        <form action="{{route('stageStore')}}" method="post">
                                            @csrf
                                            <div>
                                                <input type="hidden" name="board_id" value="{{$boards->id}}">
                                                <input type="text" name="stageName" class="btn" placeholder="new Stage" style="width: 107px">
                                                <input type="hidden" name="create_by" value="{{$boards->created_by}}">
                                                <button type="submit" class="btn btn-light">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td style="border-bottom-width: inherit">
                                @foreach($stages as $stage)
                                @if($ticket->stage_id==$stage->id)
                                <div class="col-md-8" style="width: auto">
                                    <div class="card" style="width: auto">
                                        <div class="card-header">
                                            <p>
                                                <a href="{{route('deleteTicket',['id'=>$ticket->id])}}" class="btn" style="margin: -47px -32px -41px 217px;color: red;" title="Delete Tickets"> @method('delete')X</a>
                                            </p>
                                            <p>
                                                <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#showTicketsDetailsModel" href="{{route('showTicket',['id'=>$ticket->id])}}" class="btn" title="Show details">{{$ticket->name}}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection