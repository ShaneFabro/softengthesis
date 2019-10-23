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
    <h1>{{ isset($exchangeProgram) ? 'Edit Employment history for Exchange Program' : 'Create Employment history for Exchange Program' }}</h1>
    <form action="{{ isset($exchangeProgram) ? route('update.employmenthistory.exchangeprogram', $exchangeProgram->id) : route('store.employmenthistory.exchangeprogram') }}" method="POST">
        @csrf
        @if(isset($exchangeProgram))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="institution">Institution:</label>
            <input type="text" class="form-control" name="institution" value="{{ isset($exchangeProgram) ? $exchangeProgram->institution : '' }}">
        </div>
        <div class="form-group">
            <label for="">Inclusive Date:</label>
            From:<input type="date" class="form-control" name="inclusive_from" value="{{ isset($exchangeProgram) ? $exchangeProgram->inclusive_from : '' }}">
            To:<input type="date" class="form-control" name="inclusive_to" value="{{ isset($exchangeProgram) ? $exchangeProgram->inclusive_to : '' }}">
        </div>
        <div class="form-group">
            <label for="position_title">Position/Title:</label>
            <input type="text" class="form-control" name="position_title" value="{{ isset($exchangeProgram) ? $exchangeProgram->position_title : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($exchangeProgram) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection