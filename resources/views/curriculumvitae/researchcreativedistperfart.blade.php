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
    <h1>{{ isset($distPerfArt) ? 'Edit Research and Creative Work for Distinguished performance in any of the performing arts' : 'Create Research and Creative Work for Distinguished performance in any of the performing arts' }}</h1>
    <form action="{{ isset($distPerfArt) ? route('update.research.creative.distperfart', $distPerfArt->id) : route('store.research.creative.distperfart') }}" method="POST">
        @csrf
        @if(isset($distPerfArt))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="nature_of_publication">Nature Of Publication:</label>
            <input type="text" class="form-control" name="nature_of_publication" value="{{ isset($distPerfArt) ? $distPerfArt->nature_of_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="date_publication">Date of Publication:</label>
            <input type="date" class="form-control" name="date_publication" value="{{ isset($distPerfArt) ? $distPerfArt->date_publication : '' }}">
        </div>
        <div class="form-group">
            <label for="role_comments">Role/Comments:</label>
            <input type="text" class="form-control" name="role_comments" value="{{ isset($distPerfArt) ? $distPerfArt->role_comments : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($distPerfArt) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection