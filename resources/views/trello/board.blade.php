@extends('layouts.auth')
@section('content')
@include('trello.modals.createBoard')
@include('trello.modals.newTickets')

<div class="row justify-content-center mt-1">
    <div class="col-md-8" style="width: auto">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn">{{$boards->name}}</a>
                <a href="" class="btn" style="margin-left: 100px">Invite User</a>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createBoardModel" style="float: inline-end;margin-right: 41px;">Create Board</button>
            </div>
            @if ($message = Session::get('success'))
            <div class="mt-5 alert alert-success">
                {{ $message }}
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="justify-content-center mt-5 alert alert-danger">
                {{ $message }}
            </div>
            @endif
            <div class="card-body" style="width: 100%;overflow-x: auto;">
                <table class="table" style="width: max-content;">
                    <thead>
                        @foreach($stages as $stage)
                        <th>
                            <div class="col-md-8" style="width: auto">
                                <div class="card" style="width: auto">
                                    <div class=" card-header">
                                        <p>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#createTickestModel" title="create new tickets" style="color: blue;">ADD</a>

                                            <a href="{{route('stageDelete',['id'=>$stage->id])}}" class="btn" style="margin: -76px -14px -65px 182px;color: red;" title="Delete Stage">X</a>
                                        </p>
                                        <p>
                                            {{$stage->name}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </th>
                        @endforeach
                        <th>
                            <div class="col-md-8" style="width: auto">
                                <div class="card">
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
                        <tr>
                            <td>
                                <div class="card-body">
                                    <p>
                                        First
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection