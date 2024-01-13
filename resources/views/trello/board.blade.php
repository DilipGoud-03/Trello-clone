@extends('layouts.auth')
@section('content')
@include('trello.modals.createBoard')
<div class="row justify-content-center mt-1">
    <div class="col-md-8" style="width: auto">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn">{{$boards->name}}</a>
                <a href="" class="btn" style="margin-left: 100px">Invite User</a>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createBoardModel" style="float: inline-end;margin-right: 41px;">Create Board</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        @foreach($stages as $stage)
                        <th>
                            <div class="col-md-8" style="width: auto">
                                <div class="card">
                                    <div class=" card-header">
                                        <h4>{{$stage->name}} <button class="btn btn-light" style="margin: -94px -1px -96px 22px;">Add</button></h4>
                                    </div>
                                </div>
                            </div>
                        </th>
                        @endforeach
                        <th>
                            <div class="col-md-8" style="width: auto">
                                <div class="card">
                                    <div class="card-header">
                                        <form action="">
                                            <div>
                                                <input type="text" name="stageName" class="btn" placeholder="new Stage" style="width: 107px">
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
                                    First
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