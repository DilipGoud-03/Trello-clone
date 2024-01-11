@extends('layouts.auth')
@section('content')
@include('trello.CreateBoardModal')
<div class="row justify-content-center mt-1">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header header-">
                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#myModal">
                    Create Board
                </button>

            </div>
            <div class="card-body">
                @if(Auth::user())
                <h4 class="text-align"> </h4>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection