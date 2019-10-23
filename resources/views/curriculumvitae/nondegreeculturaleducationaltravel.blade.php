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
    <h1>{{ isset($culturalEducationalTravel) ? 'Edit Non-degree for Non-degree Cultural and Educational Travel' : 'Create Non-degree Cultural and Educational Travel' }}</h1>
    <form action="{{ isset($culturalEducationalTravel) ? route('update.nondegree.culturaleducationaltravel', $culturalEducationalTravel->id) : route('store.nondegree.culturaleducationaltravel') }}" method="POST">
        @csrf
        @if(isset($culturalEducationalTravel))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" name="role" value="{{ isset($culturalEducationalTravel) ? $culturalEducationalTravel->role : '' }}">
        </div>
        <div class="form-group">
            <label for="seminar_workshop">Title of Seminar/Workshop:</label>
            <input type="text" class="form-control" name="seminar_workshop" value="{{ isset($culturalEducationalTravel) ? $culturalEducationalTravel->seminar_workshop : '' }}">
        </div>
        <div class="form-group">
            <label for="venue">Venue:</label>
            <input type="text" class="form-control" name="venue" value="{{ isset($culturalEducationalTravel) ? $culturalEducationalTravel->venue : '' }}">
        </div>
        <div class="form-group">
            <label for="inclusive_date">Inclusive Date:</label>
            <input type="date" class="form-control" name="inclusive_date" value="{{ isset($culturalEducationalTravel) ? $culturalEducationalTravel->inclusive_date : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($culturalEducationalTravel) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection