@extends('layouts.auth')
@section('content')
@include('trello.modals.modelForm')
<div class="row justify-content-center mt-1">
    <div class="col-md-8">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        <div class="card">
            @if(!empty($board))
            <div class="card-header header-">
                <!-- Button to Open the Modal -->
                <div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">Create Board</button>
                </div>
            </div>
            @endif
            <div class="card-body">
                <table class="table table-">
                    <thead>
                        <th>Sr.No</th>
                        <th>Board Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($board as $newboard)

                        @if(auth()->user()->id ==$newboard->created_by)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>
                                <a href="{{route('board',[$newboard->id])}}" class="btn" title="show board details">{{$newboard->name}}</a>
                            </td>
                            <td>
                                <a href="" class="btn btn-danger" title="delete board">Delete</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection