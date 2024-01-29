@extends('layouts.auth')
<div class="row justify-content-center mt-1">
    @section('content')
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('message'))
        <div class="alert alert-green">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header header-">
            <!-- Button to Open the Modal -->
            <div style="margin-left: 130px">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">Create Board</button>
                <div class="modal" id="myModal" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div id="container" class="container mt-1">
                                    <form id="multi_step_form" action="javascript:void(0)" method="post">
                                        <!--create board -->
                                        @csrf
                                        <div class="step step-1">
                                            <h4> Create Board</h4>
                                            <div class="mt-3">
                                                <label for="board_name" class="form-label">Board Name:</label>
                                                <input type="hidden" name="created_by" id="created_by" value=" {{Auth::user()->id}}">
                                                <input type=" text" class="form-control @error('board_name') is-invalid @enderror" id="board_name" name="board_name">
                                                <small class="text-danger" id="board_name_error"></small>

                                            </div>
                                            <div class="mt-3">
                                                <label for="board_description" class="form-label">Board Description:</label>
                                                <textarea class="form-control @error('board_description') is-invalid @enderror" name="board_description" id="board_description"></textarea>

                                                <small class="text-danger" id="board_description_error"></small>

                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                            </div>
                                        </div>
                                        <!-- Invite User -->
                                        <div class="step step-2">
                                            <h4>Invite User</h4>
                                            <div class="mt-3">
                                                <label for="user_email" class="form-label">User email:</label>
                                                <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email" name="user_email">
                                                <small class="text-danger" id="user_email_error"></small>

                                            </div>
                                            <div class="mt-3">
                                                <label for="role" class="form-label">Select Role:</label>
                                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                                    <option value="Manager">Manager</option>
                                                    <option value="Project Manager">Project Manager</option>
                                                    <option value="Developer">Developer</option>
                                                </select>
                                                <small class="text-danger" id="role_error"></small>
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-danger prev-step">Previous</button>
                                                <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                            </div>
                                        </div>
                                        <!-- Create Stages -->
                                        <div class="step step-3">
                                            <div class="col-md-12">
                                                <div class="alert alert-green" id="success-message"></div>
                                            </div>
                                            <h4>Create Stages</h4>
                                            <div class="mt-3">
                                                <label for="stage_name" class="form-label">Stage Name:</label>
                                                <input type="text" class="form-control @error('stage_name') is-invalid @enderror" id="stage_name" name="stage_name">
                                            </div>
                                            <div class="mt-3">
                                                <label for="stage_description" class="form-label">Description:</label>
                                                <textarea class="form-control @error('stage_description') is-invalid @enderror" id="stage_description" name="stage_description"></textarea>
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-danger prev-step">Previous</button>
                                                <button type="submit" id="submit" class="btn btn-success" style="float: inline-end">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body" style="margin: 16px 147px -16px 125px;">
            <table class="table table-">
                <thead>
                    <th>Board Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($board as $newboard)

                    @if(auth()->user()->id ==$newboard->created_by )
                    <tr>
                        <td>
                            <a href="{{route('board',[$newboard->id])}}" class="btn" title="show board details">{{$newboard->name}}</a>
                        </td>
                        <td>
                            <a href="{{route('deleteBoard',[$newboard->id])}}" class="btn btn-danger" title="delete board">Delete</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</div>