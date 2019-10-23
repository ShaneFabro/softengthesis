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
    <h1>{{ isset($locJournal) ? 'Edit Research and Creative Work for Local Journal' : 'Create Research and Creative Work for Local Journal' }}</h1>
    <form action="{{ isset($locJournal) ? route('update.research.scholar.locjournal', $locJournal->id) : route('store.research.scholar.locjournal') }}" method="POST">
        @csrf
        @if(isset($locJournal))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nature_of_publication">Nature Of Publication:</label>
            <input type="text" class="form-control" name="nature_of_publication" value="{{ isset($locJournal) ? $locJournal->nature_of_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="date_publication">Date of Publication:</label>
            <input type="date" class="form-control" name="date_publication" value="{{ isset($locJournal) ? $locJournal->date_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="role_comments">Role/Comments:</label>
            <input type="text" class="form-control" name="role_comments" value="{{ isset($locJournal) ? $locJournal->role_comments : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($locJournal) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection