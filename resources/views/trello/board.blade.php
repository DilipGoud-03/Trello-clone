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
        <div class="alert alert-green success_message">
            {{ $message }}
        </div>
        @endif
    </div>
</div>
<div class="card">
    <div class="card-header bg-info">
        <h5 style="margin: 3px 20px -30px">{{$boards->name}}</h5>
        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewInvitedUser" style="margin-left: 190px" title="Users"><img src="https://findnerd.com/images/defaultprofileimage.jpg" style="border-radius: 120px;width: 20px;"><img src="https://findnerd.com/images/defaultprofileimage.jpg" style="border-radius: 120px;width: 25px;"><img src="https://findnerd.com/images/defaultprofileimage.jpg" style="border-radius: 120px;width: 30px;"></a>
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
                        <div id="container" class="mt-1">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Name</th>
                                    <th>User_role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($user_Invites as $userInvite)
                                    <tr>
                                        <td>{{$userInvite->name}}</td>
                                        <td>{{$userInvite->role}}</td>
                                        <td>{{$userInvite->status}}</td>
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
        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#inviteNewUser" style="margin-left: 30px">Invite New</a>
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createBoardModel" style="float: inline-end;margin-right: 41px;">Create Board</button>
    </div>
</div>
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
                <form id="multi-step-form" action="{{route('boardStore')}}" method="post">
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
                        <label for="description" class="form-label">Board Description:</label>
                        <input type=" text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">
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
<div class="mt-3">
    <div class="card bg-danger" style="width: max-content;">
        <div class="card-body">
            <table>
                <thead>

                    <div id="stage_sortable" class="stage_list_ul">
                        @foreach($stages as $stage)
                        <li style="display: inline-block;margin-right: 20px;" class="ui-state-default" data-id="{{ $stage->id }}">
                            <a type="button" class="createTicketsModel" data-bs-toggle="modal" data-bs-target="#createTicketsModel" data-id="{{ $stage->id }}" title="create new tickets" style="color: blue;">ADD</a>
                            <a href="{{route('stageDelete',['id'=>$stage->id])}}" class="btn" style="margin: -76px -14px -65px 182px;color: red;" title="Delete Stage">X</a>
                            <h5 style="text-align: center;margin: auto;">
                                {{$stage->name}}
                            </h5>
                        </li>
                        @endforeach
                        <li style="display: inline-block;margin-right: 20px;" class="ui-state-default">
                            <form action=" {{route('stageStore')}}" method="post">
                                @csrf
                                <input type="text" name="stageName" class="btn" placeholder="new Stage" style="width: 177px">
                                <input type="hidden" name="board_id" value="{{$boards->id}}">
                                <input type="hidden" name="create_by" value="{{$boards->created_by}}">
                                <button type="submit" class="btn btn-light">Add</button>
                            </form>
                        </li>
                    </div>

                </thead>
                <tbody>
                    <tr>
                        @foreach($stages as $stage)
                        <td style=" width: 0%;">
                            @foreach($tickets as $ticket)
                            @if($ticket->stage_id==$stage->id )
                            <div id="ticket_sortable" class="ticket_list_ul">
                                <li class="ui-state-default" data-id="{{ $ticket->id }}">
                                    <p><a href="{{route('deleteTicket',['id'=>$ticket->id])}}" class="btn" style="margin: -7px -16px -50px 222px;color: red;" title="Delete Tickets">X</a></p>
                                    <p style="text-align: center;margin: auto;">
                                        <a type="button" class="btn ticketsDetailsModal" data-bs-toggle="modal" data-id="{{$ticket->id}}" data-bs-target="#ticketsDetailsModal" title="Show details">{{$ticket->name}}</a>
                                    </p>
                                </li>
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
@foreach($tickets as $ticket)
<div class="modal" id="ticketsDetailsModal" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>{{$ticket->name}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h3 class="my_tickets_id"></h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name :</label>
                    <input type="text" name="name" class="form-control" disabled value="{{$ticket->name}}" />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea name="description" class="form-control" rows="5" disabled value="">{{$ticket->description}}</textarea>
                </div>
                <div class="col-auto">
                    <div class="mt-5 mb-4">Attachments</div>
                    <div class="mb-3">
                        <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#attachmentModal" title="Show details">
                            <h2>+</h2>
                        </a>
                    </div>
                    <div class="modal" id="attachmentModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form class="form" action="">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="attachmentName" class="form-lable">Name :</label>
                                            <input type="hidden" name="tickets_id" id="tickets_id" class="form-control">
                                            <input type="text" name="attachmentName" id="attachmentName" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="path" class="form-lable">Path :</label>
                                            <input type="text" name="path" id="path" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="type" class="form-lable">Type :</label>
                                            <input type="text" name="type" id="type" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" form-control mb-5">
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="" class="btn" style="color: red;" title="Delete">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-3">Comments:</div>
                @foreach($comments as $comment)
                @if($comment->tickets_id==$ticket->id)
                <div class="col-auto">
                    <div class="group dropend mt-3 mb-3" style="border: 2px solid lavenderblush;border-radius: 12px;background: azure;margin: 12px">
                        <p class="btn" type="button" data-bs-toggle="dropdown" style="margin: 8px 0px 7px 32px;">{{$comment->comment}}</p>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu">
                                <a class="btn" style="color: red;" href="{{route('commentsDelete',['id'=>$comment->id])}}">Delete</a>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <form id="commentsForm" action="javascript:void(0)" method="post">
                    @csrf
                    <div>
                        <input type="hidden" id="created_by" name="created_by" value="{{auth()->user()->id}}">
                        <input type="hidden" id="ticket_id" name="tickets_id" value="{{$ticket->id}}">
                        <input type="text" id="comment" name="comment" class="form-control" placeholder="Comment Here" style="width:60%;display: inline-block;" value="">
                        <button type="submit" class="btn btn-info" style="margin-left: 12px">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@foreach($stages as $stage)
<div class="modal" id="createTicketsModel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Create Tickets</h4>
                <div class="alert alert-green" id="success_message"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="container" class="container">
                    <form id="tickets_form" action="javascript:void(0)" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="ticketsName" class="form-label">Tickets Name:</label>
                            <input type=" text" class="form-control @error('ticketsName') is-invalid @enderror" id="ticketsName" name="ticketsName">
                            <small class="text-danger" id="ticketsName_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Ticket Description:</label>
                            <input type=" text" class="form-control @error('description') is-invalid @enderror" id="ticket_description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="assignee" class="form-label">Assign user:</label>
                            <input type=" email" class="form-control" id="ticket_assignee" name="assignee">
                            <small class="text-danger" id="ticket_assignee_error"></small>
                        </div>
                        <div class="mb-3">
                            <button type="submit" id="submit" class="btn btn-info">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection