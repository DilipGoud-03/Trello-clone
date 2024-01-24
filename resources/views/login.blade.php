@extends('layouts/auth')
@section('content')
<div class="container mt-6">
    <div class=" container card w-50">
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
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @endif
        <div class="card-header">
            Login Here
        </div>
        <div class="card-body">
            <form action="{{route('loginRequest')}}" method="post">
                @csrf
                <div class="mt-3 mb-6 row">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email')}}</small>
                    @endif
                </div>
                <div class="mt-3 mb-6 row">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>
                <div class=" mt-3 mb-1">
                    <button type="submit" class="btn btn-secondary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection