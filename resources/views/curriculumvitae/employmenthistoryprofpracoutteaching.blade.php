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
    <h1>{{ isset($profPracOutTeaching) ? 'Edit Employment history for Professional Practice Outside Teaching' : 'Create Employment history for Professional Practice Outside Teaching' }}</h1>
    <form action="{{ isset($profPracOutTeaching) ? route('update.employmenthistory.profpracoutteaching', $profPracOutTeaching->id) : route('store.employmenthistory.profpracoutteaching') }}" method="POST">
        @csrf
        @if(isset($profPracOutTeaching))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="institution">Institution:</label>
            <input type="text" class="form-control" name="institution" value="{{ isset($profPracOutTeaching) ? $profPracOutTeaching->institution : '' }}">
        </div>
        <div class="form-group">
            <label for="">Period of employment:</label>
            From:<input type="year" class="form-control" name="period_of_employment_from" value="{{ isset($profPracOutTeaching) ? $profPracOutTeaching->period_of_employment_from : '' }}">
            To:<input type="year" class="form-control" name="period_of_employment_to" value="{{ isset($profPracOutTeaching) ? $profPracOutTeaching->period_of_employment_to : '' }}">
        </div>
        <div class="form-group">
            <label for="position_title">Position/Title:</label>
            <input type="year" class="form-control" name="position_title" value="{{ isset($profPracOutTeaching) ? $profPracOutTeaching->position_title : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($profPracOutTeaching) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection