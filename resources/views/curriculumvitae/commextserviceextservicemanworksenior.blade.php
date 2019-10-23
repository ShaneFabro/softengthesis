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
    <h1>{{ isset($extServiceManWorkSenior) ? 'Edit Community Extension Service for Senior Partner in a nationally recognized professional partnership' : 'Create Community Extension Service for Senior Partner in a nationally recognized professional partnership' }}</h1>
    <form action="{{ isset($extServiceManWorkSenior) ? route('update.commextserviceextservice.manwork.senior', $extServiceManWorkSenior->id) : route('store.commextserviceextservice.manwork.senior') }}" method="POST">
        @csrf
        @if(isset($extServiceManWorkSenior))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="inclusive_years_from">Inclusive Year From:</label>
            <input type="year" class="form-control" name="inclusive_years_from" value="{{ isset($extServiceManWorkSenior) ? $extServiceManWorkSenior->inclusive_years_from : '' }}">
        </div>
        <div class="form-group">
            <label for="inclusive_years_to">Inclusive Year To:</label>
            <input type="year" class="form-control" name="inclusive_years_to" value="{{ isset($extServiceManWorkSenior) ? $extServiceManWorkSenior->inclusive_years_to : '' }}">
        </div>
        <div class="form-group">
            <label for="title">Title/Nature of Activities / Services:</label>
            <input type="text" class="form-control" name="title" value="{{ isset($extServiceManWorkSenior) ? $extServiceManWorkSenior->title : '' }}">
        </div>
        <div class="form-group">
            <label for="position">Role/Participation:</label>
            <input type="text" class="form-control" name="position" value="{{ isset($extServiceManWorkSenior) ? $extServiceManWorkSenior->position : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($extServiceManWorkSenior) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection