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
     
    <div class="container">
        <h1 class="text-center">Create User</h1>
        <form action="{{ isset($memberEdit) ? route('admin.update', $memberEdit->id) : route('admin.store') }}" method="POST">
            @csrf
            @if(isset($memberEdit))
                @method('PUT')
            @endif
            <div class="form-group mt-5">
                <label for="">Username: </label>
                <input type="text" name="username" class="form-control" value="{{ isset($memberEdit) ? $memberEdit->username : old('username') }}">
            </div>
            <div class="form-group mt-5">
                <label for="name">Name: </label>
                <input type="text" name="name" class="form-control" value="{{ isset($memberEdit) ? $memberEdit->name : old('name') }}">
            </div>
            <div class="form-group mt-5">
                <label for="role_id">Role: </label>
                <select name="role_id" id="role_id" class="form-control">
                    <option value="" selected disabled hidden>Choose Role</option>
                    <option value="2" @if(isset($memberEdit)) @if($memberEdit->role_id == 2) selected @endif @endif>Faculty Admin</option>
                    <option value="3" @if(isset($memberEdit)) @if($memberEdit->role_id == 3) selected @endif @endif>Faculty Head</option>
                    <option value="4" @if(isset($memberEdit)) @if($memberEdit->role_id == 4) selected @endif @endif>Faculty Member</option>
                </select>
            </div>
            <div class="form-group mt-5">
                <label for="rank_id">Department: </label>
                <select name="rank_id" id="rank_id" class="form-control">
                    <option value="" selected disabled hidden>Choose Department</option>
                    <option value="1" @if(isset($memberEdit)) @if($memberEdit->rank_id == 1) selected @endif @endif>English Studies</option>
                    <option value="2" @if(isset($memberEdit)) @if($memberEdit->rank_id == 2) selected @endif @endif>Literatures</option>
                    <option value="3" @if(isset($memberEdit)) @if($memberEdit->rank_id == 3) selected @endif @endif>Philosophy</option>
                    <option value="4" @if(isset($memberEdit)) @if($memberEdit->rank_id == 4) selected @endif @endif>Economics</option>
                    <option value="5" @if(isset($memberEdit)) @if($memberEdit->rank_id == 5) selected @endif @endif>Foreign Language</option>
                    <option value="6" @if(isset($memberEdit)) @if($memberEdit->rank_id == 6) selected @endif @endif>Political Science</option>
                    <option value="7" @if(isset($memberEdit)) @if($memberEdit->rank_id == 7) selected @endif @endif>Sociology</option>
                    <option value="8" @if(isset($memberEdit)) @if($memberEdit->rank_id == 8) selected @endif @endif>History</option>
                    <option value="9" @if(isset($memberEdit)) @if($memberEdit->rank_id == 9) selected @endif @endif>Communication & Media Studies</option>
                    <option value="10" @if(isset($memberEdit)) @if($memberEdit->rank_id == 10) selected @endif @endif>Interdisciplinary</option>
                </select>
            </div>
            @if(!isset($memberEdit))
                <div class="form-group mt-5">
                    <label for="password">Password: </label>
                    <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                </div>
            @endif
            <div class="form-group mt-5">
                <input type="submit" name="submit" class="btn btn-success" value="{{ isset($memberEdit) ? 'Update User' : 'Create User' }}"> 
            </div>
        </form>
    </div>
    <div>
        @include('partials.errors')
    </div>

 @endsection