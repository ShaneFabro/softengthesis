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
    <h1>{{ isset($presentStatus) ? 'Edit Academic Present Status' : 'Create Academic Present Status' }}</h1>
    <form action="{{ isset($presentStatus) ? route('update.academic.present', $presentStatus->id) : route('store.academic.present') }}" method="POST">
        @csrf
        @if(isset($presentStatus))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="academic_rank">Academic Rank:</label>
            <select name="academic_rank" id="academic_rank" class="form-control">
                <option value="1" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 1) selected @endif @endif>Instructor I</option>
                <option value="2" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 2) selected @endif @endif>Instructor II</option>
                <option value="3" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 3) selected @endif @endif>Instructor III</option>
                <option value="4" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 4) selected @endif @endif>Instructor IV</option>
                <option value="5" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 5) selected @endif @endif>Instructor V</option>
                <option value="6" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 6) selected @endif @endif>Asst. Proffesor I</option>
                <option value="7" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 7) selected @endif @endif>Asst. Proffesor II</option>
                <option value="8" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 8) selected @endif @endif>Asst. Proffesor III</option>
                <option value="9" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 9) selected @endif @endif>Asst. Proffesor IV</option>
                <option value="10" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 10) selected @endif @endif>Asst. Proffesor V</option>
                <option value="11" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 11) selected @endif @endif>Assoc. Proffesor I</option>
                <option value="12" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 12) selected @endif @endif>Assoc. Proffesor II</option>
                <option value="13" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 13) selected @endif @endif>Assoc. Proffesor III</option>
                <option value="14" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 14) selected @endif @endif>Assoc. Proffesor IV</option>
                <option value="15" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 15) selected @endif @endif>Assoc. Proffesor V</option>
                <option value="16" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 16) selected @endif @endif>Proffesor I</option>
                <option value="17" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 17) selected @endif @endif>Proffesor II</option>
                <option value="18" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 18) selected @endif @endif>Proffesor III</option>
                <option value="19" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 19) selected @endif @endif>Proffesor IV</option>
                <option value="20" @if(isset($presentStatus)) @if($presentStatus->academic_rank == 20) selected @endif @endif>Proffesor V</option>
            </select>
        </div>
        <div class="form-group">
            <label for="employment_status">Employment Status:</label>
            <input type="text" class="form-control" name="employment_status" value="{{ isset($presentStatus) ? $presentStatus->employment_status : '' }}">
        </div>
        <div class="form-group">
            <label for="year_appointed_in_ust">Year Appointed in UST:</label>
            <input type="year" class="form-control" name="year_appointed_in_ust" value="{{ isset($presentStatus) ? $presentStatus->year_appointed_in_ust : '' }}">
        </div>
        <div class="form-group">
            <label for="num_of_years_in_ust">No. of years in UST:</label>
            <input type="year" class="form-control" name="num_of_years_in_ust" value="{{ isset($presentStatus) ? $presentStatus->num_of_years_in_ust : '' }}">
        </div>
        <div class="form-group">
            <label for="pos_in_ust">Position in UST:</label>
            <input type="year" class="form-control" name="pos_in_ust" value="{{ isset($presentStatus) ? $presentStatus->pos_in_ust : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($presentStatus) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection