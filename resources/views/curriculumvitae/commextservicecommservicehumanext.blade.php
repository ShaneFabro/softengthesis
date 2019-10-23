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
    <h1>{{ isset($humanExtInitiate) ? 'Edit Community Extension Service for Humanitarian/Relief Mission in Externally-Initiated' : 'Create Community Extension Service for Humanitarian/Relief Mission in Externally-Initiated' }}</h1>
    <form action="{{ isset($humanExtInitiate) ? route('update.commextservicecommservice.humanext', $humanExtInitiate->id) : route('store.commextservicecommservice.humanext') }}" method="POST">
        @csrf
        @if(isset($humanExtInitiate))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="inclusive_date_from">Inclusive Date From:</label>
            <input type="date" class="form-control" name="inclusive_date_from" value="{{ isset($humanExtInitiate) ? $humanExtInitiate->inclusive_date_from : '' }}">
        </div>
        <div class="form-group">
            <label for="inclusive_date_to">Inclusive Date To:</label>
            <input type="date" class="form-control" name="inclusive_date_to" value="{{ isset($humanExtInitiate) ? $humanExtInitiate->inclusive_date_to : '' }}">
        </div>
        <div class="form-group">
            <label for="title">Title/Nature of Activities / Services:</label>
            <input type="text" class="form-control" name="title" value="{{ isset($humanExtInitiate) ? $humanExtInitiate->title : '' }}">
        </div>
        <div class="form-group">
            <label for="role">Role/Participation:</label>
            <input type="text" class="form-control" name="role" value="{{ isset($humanExtInitiate) ? $humanExtInitiate->role : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($humanExtInitiate) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection