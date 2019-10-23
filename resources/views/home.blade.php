@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    {{-- @if(auth()->user()->role_id == 1)
                        You're Logged in as System Administrator!
                    @elseif(auth()->user()->role_id == 2)
                        You're Logged in as Dean!
                    @elseif(auth()->user()->role_id == 3)
                        You're Logged in as Faculty Head!
                    @elseif(auth()->user()->role_id == 4)
                        You're Logged in as Faculty Member!
                    @endif --}}
                    @if(auth()->check())
                    You're Logged in as {{ auth()->user()->role->rolename }} ! 
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ route('admin.index') }}" class="btn btn-info">Go back to your home page.</a>
                    @elseif(auth()->user()->role_id == 2)
                        <a href="{{ route('dean.index') }}" class="btn btn-info">Go back to your home page.</a>
                    @elseif(auth()->user()->role_id == 3)
                        <a href="{{ route('head.index') }}" class="btn btn-info">Go back to your home page.</a>
                    @elseif(auth()->user()->role_id == 4)
                        <a href="{{ route('member.index') }}" class="btn btn-info">Go back to your home page.</a>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection