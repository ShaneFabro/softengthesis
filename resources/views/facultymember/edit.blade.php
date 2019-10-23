@extends('layouts.inside')

@section('top-nav-bar')

@include('top-nav-bar.member')

@endsection
    
@section('side-nav-bar')

@include('side-nav-bar.member')

@endsection

@section('content')
    

    @if(auth()->user()->personalParticular()->count() == 0)
    <div class="text-center">
    <h1>No Info</h1>
    <br>
    <a href="{{ route('member.beforeedit', auth()->user()->id) }}" class="btn btn-info">Add Personal Particular</a>
    </div>
    @elseif(auth()->user()->personalParticular()->count() > 0)
        
    <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header bg-primary">
                            <h3 class="col-md-4">Personal Particular</h3>
                            <a href="{{ route('member.edit', auth()->user()->personalParticular->user_id) }}" class="btn btn-success float-right">Edit</a>
                        </div>
                        <div class="card-body">
                            <strong>Name:</strong> {{ auth()->user()->personalParticular->fullname }}
                            <br>
                            <br>
                            <strong>Sex:</strong> {{ auth()->user()->personalParticular->sex == 0 ? 'Male' : 'Female' }}
                            <br>
                            <br>
                            <strong>Religion:</strong> {{ auth()->user()->personalParticular->religion }}
                            <br>
                            <br>
                            <strong>Occupation:</strong> {{ auth()->user()->personalParticular->occupation }}
                            <br>
                            <br>
                            <strong>Address:</strong> {{ auth()->user()->personalParticular->address }}
                            <br>
                            <br>
                            <strong>Age:</strong> {{ auth()->user()->personalParticular->age }}
                            <br>
                            <br>
                            <strong>Telephone:</strong> {{ auth()->user()->personalParticular->telephone }}
                            <br>
                            <br>
                            <strong>Mobilephone:</strong> {{ auth()->user()->personalParticular->mobilephone }}
                            <br>
                            <br>
                            <strong>Email Address:</strong> {{ auth()->user()->personalParticular->email }}
                            <br>
                            <br>
                            <strong>Date of Birth:</strong> {{ auth()->user()->personalParticular->birth }}
                            <br>
                            <br>
                            <strong>Place of Birth:</strong> {{ auth()->user()->personalParticular->place_birth }}
                            <br>
                            <br>
                            <strong>Citizenship:</strong> {{ auth()->user()->personalParticular->citizenship }}
                            <br>
                            <br>
                            <strong>Marital Status:</strong> {{ auth()->user()->personalParticular->marital_status }}
                            <br>
                            <br>
                            <strong>Name of Spouse:</strong> {{ auth()->user()->personalParticular->spouse == null ? 'Not Applicable' : auth()->user()->personalParticular->spouse }}
                            <br>
                            <br>
                            <strong>Names and Ages of Children:</strong> {{ auth()->user()->personalParticular->names_ages_of_children == null ? 'Not Applicable' : auth()->user()->personalParticular->names_ages_of_children }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @endif

@endsection