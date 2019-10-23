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
    <h1>{{ isset($genCirculation) ? 'Edit Research and Creative Work for Critiques, Position papers published in newspapers of general Circulation' : 'Create Research and Creative Work for Critiques, Position papers published in newspapers of general Circulation' }}</h1>
    <form action="{{ isset($genCirculation) ? route('update.research.creative.gencirculation', $genCirculation->id) : route('store.research.creative.gencirculation') }}" method="POST">
        @csrf
        @if(isset($genCirculation))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nature_of_publication">Nature Of Publication:</label>
            <input type="text" class="form-control" name="nature_of_publication" value="{{ isset($genCirculation) ? $genCirculation->nature_of_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="date_publication">Date of Publication:</label>
            <input type="date" class="form-control" name="date_publication" value="{{ isset($genCirculation) ? $genCirculation->date_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="role_comments">Role/Comments:</label>
            <input type="text" class="form-control" name="role_comments" value="{{ isset($genCirculation) ? $genCirculation->role_comments : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($genCirculation) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection