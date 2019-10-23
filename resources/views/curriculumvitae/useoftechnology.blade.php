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
    <h1>{{ isset($useOfTechnology) ? 'Edit Use of Information Technology in Instructional Delivery' : 'Create Use of Information Technology in Instructional Delivery' }}</h1>
    <form action="{{ isset($useOfTechnology) ? route('update.useoftechnology', $useOfTechnology->id) : route('store.useoftechnology') }}" method="POST">
        @csrf
        @if(isset($useOfTechnology))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="subjects_taught">Subjects Taught:</label>
            <input type="text" class="form-control" name="subjects_taught" value="{{ isset($useOfTechnology) ? $useOfTechnology->subjects_taught : '' }}">
        </div>
        <div class="form-group">
            <label for="yes_no">Do you use IT-based instructional aid in teaching the subject?:</label>
            <select name="yes_no" id="" class="form-control">
                <option value="1" 
                @if(isset($useOfTechnology))
                    @if($useOfTechnology->yes_no == 1)
                    selected
                    @endif
                @endif
                >Yes</option>
                <option value="0"
                @if(isset($useOfTechnology))
                    @if($useOfTechnology->yes_no == 0)
                    selected
                    @endif
                @endif 
                >No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nature_it_used">If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.)</label>
            <input type="text" class="form-control" name="nature_it_used" value="{{ isset($useOfTechnology) ? $useOfTechnology->nature_it_used : '' }}">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($useOfTechnology) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')

@endsection