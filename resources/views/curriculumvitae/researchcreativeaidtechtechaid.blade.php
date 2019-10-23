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
    <h1>{{ isset($aidTechTechAid) ? 'Edit Research and Creative Work for Teaching aids produced for use in the department and /or Faculty or College' : 'Create Research and Creative Work for Teaching aids produced for use in the department and /or Faculty or College' }}</h1>
    <form action="{{ isset($aidTechTechAid) ? route('update.research.creative.aidtech.techaid', $aidTechTechAid->id) : route('store.research.creative.aidtech.techaid') }}" method="POST">
        @csrf
        @if(isset($aidTechTechAid))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nature_of_publication">Nature Of Publication:</label>
            <input type="text" class="form-control" name="nature_of_publication" value="{{ isset($aidTechTechAid) ? $aidTechTechAid->nature_of_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="date_publication">Date of Publication:</label>
            <input type="date" class="form-control" name="date_publication" value="{{ isset($aidTechTechAid) ? $aidTechTechAid->date_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="role_comments">Role/Comments:</label>
            <input type="text" class="form-control" name="role_comments" value="{{ isset($aidTechTechAid) ? $aidTechTechAid->role_comments : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($aidTechTechAid) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection