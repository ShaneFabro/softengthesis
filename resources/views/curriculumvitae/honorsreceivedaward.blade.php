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
    <h1>{{ isset($honorsReceivedAward) ? 'Edit Scholarships, Honors And/Or Awards Received in Awards' : 'Create Scholarships, Honors And/Or Awards Received in Awards' }}</h1>
    <form action="{{ isset($honorsReceivedAward) ? route('update.honorsreceived.award', $honorsReceivedAward->id) : route('store.honorsreceived.award') }}" method="POST">
        @csrf
        @if(isset($honorsReceivedAward))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="from">From:</label>
            <input type="date" class="form-control" name="from" value="{{ isset($honorsReceivedAward) ? $honorsReceivedAward->from : '' }}">
        </div>
        <div class="form-group">
            <label for="to">To:</label>
            <input type="date" class="form-control" name="to" value="{{ isset($honorsReceivedAward) ? $honorsReceivedAward->to : '' }}">
        </div>
        <div class="form-group">
            <label for="nature_gov_exam">Nature of Scholarship:</label>
            <input type="text" class="form-control" name="nature_gov_exam" value="{{ isset($honorsReceivedAward) ? $honorsReceivedAward->nature_gov_exam : '' }}">
        </div>
        <div class="form-group">
            <label for="grade">Status (Grade):</label>
            <input type="text" class="form-control" name="grade" value="{{ isset($honorsReceivedAward) ? $honorsReceivedAward->grade : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($honorsReceivedAward) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection