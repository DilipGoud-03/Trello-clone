@extends('layouts.auth')
<div class="row justify-content-center mt-1">
    @section('content')
    <div class="col-md-8">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-error">
            {{ $message }}
        </div>
        @endif
        @if ($message = Session::get('message'))
        <div class="alert alert-message">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="card">
        @if(!empty($board))
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
                                    <form id="multi-step-form" action="{{route('modalData')}}" method="post">
                                        <!--create board -->
                                        @csrf
                                        <div class="step step-1">
                                            <h4> Create Board</h4>
                                            <div class="mt-3">
                                                <label for="boardName" class="form-label">Board Name:</label>
                                                <input type="hidden" name="created_by" value=" {{Auth::user()->id}}">
                                                <input type=" text" class="form-control @error('boardName') is-invalid @enderror" id="boardName" name="boardName">
                                                @if ($errors->has('boardName'))
                                                <small class="text-danger">{{ $errors->first('boardName')}}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <label for="baordDescription" class="form-label">Board Description:</label>
                                                <textarea class="form-control @error('baordDescription') is-invalid @enderror" name="baordDescription" id="baordDescription"></textarea>
                                                @if ($errors->has('baordDescription'))
                                                <small class="text-danger">{{ $errors->first('baordDescription') }}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                            </div>
                                        </div>

                                        <!-- Invite User -->
                                        <div class="step step-2">
                                            <h4>Invite User</h4>
                                            <div class="mt-3">
                                                <label for="userEmail" class="form-label">User email:</label>
                                                <input type="email" class="form-control @error('userEmail') is-invalid @enderror" id="userEmail" name="userEmail">
                                                @if ($errors->has('userEmail'))
                                                <small class="text-danger">{{ $errors->first('userEmail') }}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <label for="role" class="form-label">Select Role:</label>
                                                <select name="role" id="role" class="selectpicker form-control @error('role') is-invalid @enderror">
                                                    <option value="Manager">Manager</option>
                                                    <option value="Project Manager">Project Manager</option>
                                                    <option value="Developer">Developer</option>
                                                </select>
                                                @if ($errors->has('role'))
                                                <small class="text-danger">{{ $errors->first('role') }}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-danger prev-step">Previous</button>
                                                <button type="button" class="btn btn-dark next-step" style="float: inline-end">Next</button>
                                            </div>
                                        </div>

                                        <!-- Create Stages -->
                                        <div class="step step-3">
                                            <h4>Create Stages</h4>
                                            <div class="mt-3">
                                                <label for="stageName" class="form-label">Stage Name:</label>
                                                <input type="text" class="form-control @error('stageName') is-invalid @enderror" id="stageName" name="stageName">
                                                @if ($errors->has('stageName'))
                                                <small class="text-danger">{{ $errors->first('stageName') }}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <label for="stageDescription" class="form-label">Description:</label>
                                                <textarea class="form-control @error('stageDescription') is-invalid @enderror" id="stageDescription" name="stageDescription"></textarea>
                                                @if ($errors->has('stageDescription'))
                                                <small class="text-danger">{{ $errors->first('stageDescription') }}</small>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-danger prev-step">Previous</button>
                                                <button type="submit" class="btn btn-success" style="float: inline-end">Submit</button>
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
        @endif
        <div class="card-body" style="margin: 16px 147px -16px 125px;">
            <table class="table table-">
                <thead>
                    <th>Board Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($board as $newboard)

                    @if(auth()->user()->id ==$newboard->created_by)
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