@extends('layouts/auth')
@section('content')
<div class="container mt-6">
    <div class=" container card w-50">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        <div class="card-header">
            Register Here
        </div>
        <div class="card-body">
            <form action="{{route('store')}}" method="post">
                @csrf
                <div class="mt-1 mb-6 row ">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>
                <div class="mt-3 mb-6 row">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="mt-3 mb-6 row">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                    @endif
                </div>
                <div class="mt-3 mb-6 row">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                    @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                    @endif
                </div>
                <div class=" mt-3 mb-1">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection