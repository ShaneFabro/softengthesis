@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.head')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.head')

@endsection

@section('content')
    
    <h2 class="text-center">Change Password</h2>
    <div class="container">
        <form action="{{ route('head.changepassword.confirm') }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group mt-5">
                <label for="oldpassword">Old Password:</label>
                <input type="password" name="oldpassword" class="form-control">
            </div>
            <div class="form-group mt-5">
                <label for="newpassword">New Password:</label>
                <input type="password" name="newpassword" class="form-control">
            </div>
            <div class="form-group mt-5">
                <input type="submit" name="submit" class="btn btn-success" value="Change Password">
            </div>
        </form>
    </div>
    <div>
        @include('partials.errors')
    </div>
    <div>
        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
        @endif
    </div>
@endsection