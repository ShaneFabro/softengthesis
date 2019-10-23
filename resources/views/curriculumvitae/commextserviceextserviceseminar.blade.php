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
    <h1>{{ isset($extServiceSeminar) ? 'Edit Community Extension Service for Seminars/Workshops/Conferences/Convention' : 'Create Community Extension Service for Seminars/Workshops/Conferences/Convention' }}</h1>
    <form action="{{ isset($extServiceSeminar) ? route('update.commextserviceextservice.seminar', $extServiceSeminar->id) : route('store.commextserviceextservice.seminar') }}" method="POST">
        @csrf
        @if(isset($extServiceSeminar))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="inclusive_date_from">Inclusive Date From:</label>
            <input type="date" class="form-control" name="inclusive_date_from" value="{{ isset($extServiceSeminar) ? $extServiceSeminar->inclusive_date_from : '' }}">
        </div>
        <div class="form-group">
            <label for="inclusive_date_to">Inclusive Date To:</label>
            <input type="date" class="form-control" name="inclusive_date_to" value="{{ isset($extServiceSeminar) ? $extServiceSeminar->inclusive_date_to : '' }}">
        </div>
        <div class="form-group">
            <label for="title">Title/Nature of Activities / Services:</label>
            <input type="text" class="form-control" name="title" value="{{ isset($extServiceSeminar) ? $extServiceSeminar->title : '' }}">
        </div>
        <div class="form-group">
            <label for="role">Role/Participation:</label>
            <input type="text" class="form-control" name="role" value="{{ isset($extServiceSeminar) ? $extServiceSeminar->role : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($extServiceSeminar) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection