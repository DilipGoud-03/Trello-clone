@extends('layouts.auth')
@section('content')
<div class="row justify-content-center mt-1">
    <div class="col-md-8" style="width: auto">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn">{{$boards->name}}</a>
                <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewInvitedUser" style="margin-left: 100px">Invited User</a>

                <div class="modal" id="viewInvitedUser" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: max-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <div>
                                    <h4> Invited User Details</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div id="container" class="container mt-1">
                                    <table class="table">
                                        <thead>
                                            <th>User_id</th>
                                            <th>User_role</th>
                                            <th>Status</th>
                                            <th>Invited By</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($user_Invites as $userInvite)
                                            <tr>
                                                <td>{{$userInvite->user_id}}</td>
                                                <td>{{$userInvite->role}}</td>
                                                <td>{{$userInvite->status}}</td>
                                                <td>{{$userInvite->invited_by}}</td>
                                                <td>
                                                    <a class="btn" href="{{route('editUser',['id'=>$userInvite->id])}}">EDIT</a>
                                                    <a class="btn" href="{{route('deleteUser',['id'=>$userInvite->id])}}">DELETE</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inviteNewUser" style="margin-left: 100px">Invite New User</a>
                <div class="modal" id="inviteNewUser" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: max-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <div>
                                    <h4>User Details</h4>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div id="container" class="container mt-1">
                                    <form class="form" action="{{route('inviteUser')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="">User Email</label>
                                            <input type="hidden" name="boardName" value="{{$boards->name}}">
                                            <input type="hidden" name="board_id" value="{{$boards->id}}">
                                            <input type="email" class="form-control" name="email" value="">
                                            @if ($errors->has('email'))
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Select Role:</label>
                                            <select name="role" id="role" class="selectpicker form-control @error('role') is-invalid @enderror">
                                                <option value="Manager">Manager</option>
                                                <option value="Project Manager">Project Manager</option>
                                                <option value="Developer" selected>Developer</option>
                                                <input type="hidden" name="invited_by" value="{{auth()->user()->id}}">
                                            </select>
                                            @if ($errors->has('role'))
                                            <small class="text-danger">{{ $errors->first('role') }}</small>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-info">Invite</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createBoardModel" style="float: inline-end;margin-right: 41px;">Create Board</button>
                <div class="modal" id="createBoardModel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="margin-left: 507px;padding-left: 12px">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4>Create Board</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body"></div>
                            <div id="container" class="container mt-1">
                                <form id="multi-step-form" action="{{route('modalData')}}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="boardName" class="form-label">Board Name:</label>
                                        <input type="hidden" name="created_By" value=" {{Auth::user()->id}}">
                                        <input type=" text" class="form-control @error('boardName') is-invalid @enderror" id="boardName" name="boardName">
                                        @if ($errors->has('boardName'))
                                        <small class="text-danger">{{ $errors->first('boardName')}}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="decription" class="form-label">Board Description:</label>
                                        <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" onclick="" class="btn btn-success">Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#createTickestModel" title="create new tickets" style="color: blue;">ADD</a>

                                            <a href="{{route('stageDelete',['id'=>$stage->id])}}" class="btn" style="margin: -76px -14px -65px 182px;color: red;" title="Delete Stage">X</a>
                                        </p>
                                        <div class="modal" id="createTickestModel" data-bs-backdrop="static" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4>Create Tickets</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body"></div>
                                                    <div id="container" class="container">
                                                        <form id="multi-step-form" action="{{ route('ticketsStore')}}" method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <input type="hidden" name="stage_id" value="{{$stage->id}}">
                                                                <input type="hidden" name="created_by" name="created_by" value=" {{Auth::user()->id}}">
                                                                <label for="ticketsName" class="form-label">Tickets Name:</label>
                                                                <input type=" text" class="form-control @error('ticketsName') is-invalid @enderror" id="ticketsName" name="ticketsName" value="">
                                                                @if ($errors->has('ticketsName'))
                                                                <small class="text-danger">{{ $errors->first('ticketsName')}}</small>
                                                                @endif
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="decription" class="form-label">Ticket Description:</label>
                                                                <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="assinee" class="form-label">Assign user:</label>
                                                                <input type=" text" class="form-control" id="assinee" name="assinee" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <button type="submit" onclick="$('#createTickestModel').modal({'data-bs-backdrop': 'static'});" class="btn btn-info">Submit </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                            @foreach($stages as $stage)
                            @if($ticket->stage_id==$stage->id)
                            <td style="border: none">
                                <div class="col-md-8" style="width: auto;margin-bottom: 1px;">
                                    <div class="card">
                                        <div class="card-header">
                                            <p>
                                                <a href="{{route('deleteTicket',['id'=>$ticket->id])}}" class="btn" style="margin: -47px -32px -41px 217px;color: red;" title="Delete Tickets">X</a>
                                            </p>
                                            <p>
                                                <a href="{{route('showTicket',['id'=>$ticket->id])}}" class="btn" title="Show details">{{$ticket->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection