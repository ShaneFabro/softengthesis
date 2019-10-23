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
    <h1>{{ isset($honorsReceivedScholarship) ? 'Edit Scholarships, Honors And/Or Awards Received in Scholarships' : 'Create Scholarships, Honors And/Or Awards Received in Scholarships' }}</h1>
    <form action="{{ isset($honorsReceivedScholarship) ? route('update.honorsreceived.scholarship', $honorsReceivedScholarship->id) : route('store.honorsreceived.scholarship') }}" method="POST">
        @csrf
        @if(isset($honorsReceivedScholarship))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="from">From:</label>
            <input type="date" class="form-control" name="from" value="{{ isset($honorsReceivedScholarship) ? $honorsReceivedScholarship->from : '' }}">
        </div>
        <div class="form-group">
            <label for="to">To:</label>
            <input type="date" class="form-control" name="to" value="{{ isset($honorsReceivedScholarship) ? $honorsReceivedScholarship->to : '' }}">
        </div>
        <div class="form-group">
            <label for="nature_gov_exam">Nature of Scholarship:</label>
            <input type="text" class="form-control" name="nature_gov_exam" value="{{ isset($honorsReceivedScholarship) ? $honorsReceivedScholarship->nature_gov_exam : '' }}">
        </div>
        <div class="form-group">
            <label for="grade">Status (Grade):</label>
            <input type="text" class="form-control" name="grade" value="{{ isset($honorsReceivedScholarship) ? $honorsReceivedScholarship->grade : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($honorsReceivedScholarship) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection