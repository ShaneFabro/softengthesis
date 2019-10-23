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
    <h1>{{ isset($honorsReceivedGovernment) ? 'Edit Scholarships, Honors And/Or Awards Received in Government examinations passed' : 'Create Scholarships, Honors And/Or Awards Received in Government examinations passed' }}</h1>
    <form action="{{ isset($honorsReceivedGovernment) ? route('update.honorsreceived.government', $honorsReceivedGovernment->id) : route('store.honorsreceived.government') }}" method="POST">
        @csrf
        @if(isset($honorsReceivedGovernment))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="from">From:</label>
            <input type="date" class="form-control" name="from" value="{{ isset($honorsReceivedGovernment) ? $honorsReceivedGovernment->from : '' }}">
        </div>
        <div class="form-group">
            <label for="to">To:</label>
            <input type="date" class="form-control" name="to" value="{{ isset($honorsReceivedGovernment) ? $honorsReceivedGovernment->to : '' }}">
        </div>
        <div class="form-group">
            <label for="nature_gov_exam">Nature of Government Examination:</label>
            <input type="text" class="form-control" name="nature_gov_exam" value="{{ isset($honorsReceivedGovernment) ? $honorsReceivedGovernment->nature_gov_exam : '' }}">
        </div>
        <div class="form-group">
            <label for="grade">Status (Grade):</label>
            <input type="text" class="form-control" name="grade" value="{{ isset($honorsReceivedGovernment) ? $honorsReceivedGovernment->grade : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($honorsReceivedGovernment) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection