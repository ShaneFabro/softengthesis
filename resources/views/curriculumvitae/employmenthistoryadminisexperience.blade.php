@extends('layouts.inside')

@section('top-nav-bar')

@if(auth()->user()->role_id == 4)

@include('top-nav-bar.member')

@elseif(auth()->user()->role_id == 3)

@include('top-nav-bar.head')

@elseif(auth()->user()->role_id == 2)

@include('top-nav-bar.dean')

@endif

@endsection

@section('side-nav-bar')

@if(auth()->user()->role_id == 4)

@include('side-nav-bar.member')

@elseif(auth()->user()->role_id == 3)

@include('side-nav-bar.head')

@elseif(auth()->user()->role_id == 2)

@include('side-nav-bar.dean')

@endif

@endsection
@section('content')
    <h1>{{ isset($adminisExperience) ? 'Edit Employment history for administrative experience' : 'Create Employment history for administrative experience' }}</h1>
    <form action="{{ isset($adminisExperience) ? route('update.employmenthistory.adminisexperience', $adminisExperience->id) : route('store.employmenthistory.adminisexperience') }}" method="POST">
        @csrf
        @if(isset($adminisExperience))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="institution">Institution:</label>
            <input type="text" class="form-control" name="institution" value="{{ isset($adminisExperience) ? $adminisExperience->institution : '' }}">
        </div>
        <div class="form-group">
            <label for="">Period of employment:</label>
            From:<input type="year" class="form-control" name="period_of_employment_from" value="{{ isset($adminisExperience) ? $adminisExperience->period_of_employment_from : '' }}">
            To:<input type="year" class="form-control" name="period_of_employment_to" value="{{ isset($adminisExperience) ? $adminisExperience->period_of_employment_to : '' }}">
        </div>
        <div class="form-group">
            <label for="position_title">Position/Title:</label>
            <input type="year" class="form-control" name="position_title" value="{{ isset($adminisExperience) ? $adminisExperience->position_title : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($adminisExperience) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection