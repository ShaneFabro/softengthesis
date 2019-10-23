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
    <h1>{{ isset($seminarWorkshops) ? 'Edit Non-degree for Non-degree seminars and workshops' : 'Create Non-degree seminars and workshops' }}</h1>
    <form action="{{ isset($seminarWorkshops) ? route('update.nondegree.seminarworkshops', $seminarWorkshops->id) : route('store.nondegree.seminarworkshops') }}" method="POST">
        @csrf
        @if(isset($seminarWorkshops))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" name="role" value="{{ isset($seminarWorkshops) ? $seminarWorkshops->role : '' }}">
        </div>
        <div class="form-group">
            <label for="seminar_workshop">Title of Seminar/Workshop:</label>
            <input type="text" class="form-control" name="seminar_workshop" value="{{ isset($seminarWorkshops) ? $seminarWorkshops->seminar_workshop : '' }}">
        </div>
        <div class="form-group">
            <label for="venue">Venue:</label>
            <input type="text" class="form-control" name="venue" value="{{ isset($seminarWorkshops) ? $seminarWorkshops->venue : '' }}">
        </div>
        <div class="form-group">
            <label for="inclusive_date">Inclusive Date:</label>
            <input type="date" class="form-control" name="inclusive_date" value="{{ isset($seminarWorkshops) ? $seminarWorkshops->inclusive_date : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($seminarWorkshops) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection