@extends('layouts.inside')

@section('top-nav-bar')
 
 
<div style = "position: sticky; top: 0; z-index: 9999;">
    <ul class="nav nav-tabs navbar-default" style="background-color: #1DA1F2;">
        <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('admin.index') }}">Home<i class="fas fa-home"></i></a></li>
        <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('admin.viewlogs') }}">View Logs<i class="fas fa-sticky-note"></i></a></li>
        <li class="nav-item mt-3 mr-3 col-md-offset-7" style="color: azure">Logged In as <strong>System Admin</strong></li>
        <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('admin.changepassword') }}" >Change Password<i class="fas fa-key"></i></a></li>
        <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout<i class="fas fa-power-off"></i></a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
    </ul>
    
   
</div>
 
 @endsection
 
 @section('side-nav-bar')
 
 <div id="sidebar-wrapper" style="background-color: #1DA1F2">
    <ul class="sidebar-nav mt-5">
        <li> <a href="{{ route('admin.allfaculty') }}" style="color: white" class="nav-link">All Users</a></li>
        <li> <a href="{{ route('admin.create') }}" style="color: white" class="nav-link">Create Users</a></li>
        <li> <a href="{{ route('admin.trashed') }}" style="color: white" class="nav-link">Archived Users</a></li>
    </ul>
</div>
 
 @endsection

@section('content')
    
    <h2 class="text-center">Change Password</h2>
    <div class="container">
        <form action="{{ route('admin.changepassword.confirm') }}" method="POST">
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