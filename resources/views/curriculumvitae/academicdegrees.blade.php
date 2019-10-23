{{-- @extends('layouts.app')

@section('content')
    <h1>{{ isset($academic) ? 'Edit Academic Degree' : 'Create Academic Degree' }}</h1>
    <form action="{{ isset($academic) ? route('update.academic', $academic->id) : route('store.academic') }}" method="POST">
        @csrf
        @if(isset($academic))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="degree">Degree:</label>
            <input type="text" class="form-control" name="degree" value="{{ isset($academic) ? $academic->degree : '' }}">
        </div>
        <div class="form-group">
            <label for="school">School:</label>
            <input type="text" class="form-control" name="school" value="{{ isset($academic) ? $academic->school : '' }}">
        </div>
        <div class="form-group">
            <label for="year_graduated">Year Graduated:</label>
            <input type="year" class="form-control" name="year_graduated" value="{{ isset($academic) ? $academic->year_graduated : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($academic) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection --}}

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
<h1>{{ isset($academic) ? 'Edit Academic Degree' : 'Create Academic Degree' }}</h1>
<form action="{{ isset($academic) ? route('update.academic', $academic->id) : route('store.academic') }}" method="POST">
    @csrf
    @if(isset($academic))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="degree">Degree:</label>
        <input type="text" class="form-control" name="degree" value="{{ isset($academic) ? $academic->degree : '' }}">
    </div>
    <div class="form-group">
        <label for="school">School:</label>
        <input type="text" class="form-control" name="school" value="{{ isset($academic) ? $academic->school : '' }}">
    </div>
    <div class="form-group">
        <label for="year_graduated">Year Graduated:</label>
        <input type="year" class="form-control" name="year_graduated" value="{{ isset($academic) ? $academic->year_graduated : '' }}">
    </div>
    <div class="form-group">
        <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($academic) ? 'Update' : 'Create' }}">
    </div>
</form>
@include('partials.errors')
@endsection