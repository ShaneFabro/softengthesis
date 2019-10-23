@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.head')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.head')

@endsection

@section('content')
    <h1>{{ isset($particular) ? 'Edit Personal Particular' : 'Create Personal Particular' }}</h1>
    <form action="{{ isset($particular) ? route('head.update', $particular->user_id) : route('head.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($particular))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" name="firstname" value="{{ isset($particular) ? $particular->firstname : old('firstname') }}">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" name="lastname" value="{{ isset($particular) ? $particular->lastname : old('lastname') }}">
        </div>
        <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <label for="place_birth">Place of Birth:</label>
            <input type="text" class="form-control" name="place_birth" value="{{ isset($particular) ? $particular->place_birth : old('place_birth') }}">
        </div>
        <div class="form-group">
            <label for="sex">Sex:</label>
            <select name="sex" id="sex" class="form-control">
                <option value="0"
                @if(isset($particular))
                   @if($particular->sex == 0)
                    selected
                   @endif
                @endif
                >Male</option>
                <option value="1" 
                @if(isset($particular))
                   @if($particular->sex == 1)
                    selected
                   @endif
                @endif
                >Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="religion">Religion:</label>
            <input type="text" class="form-control" name="religion" value="{{ isset($particular) ? $particular->religion : old('religion') }}">
        </div>
        <div class="form-group">
            <label for="occupation">Occupation:</label>
            <input type="text" class="form-control" name="occupation" value="{{ isset($particular) ? $particular->occupation : old('occupation') }}">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ isset($particular) ? $particular->address : old('address') }}">
        </div>
        <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="number" class="form-control" name="telephone" value="{{ isset($particular) ? $particular->telephone : old('telephone') }}">
        </div>
        <div class="form-group">
            <label for="mobilephone">Mobilephone:</label>
            <input type="number" class="form-control" name="mobilephone" value="{{ isset($particular) ? $particular->mobilephone : old('mobilephone') }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ isset($particular) ? $particular->email : old('email') }}">
        </div>
        <div class="form-group">
            <label for="birth">Birthdate:</label>
            <input type="date" class="form-control" name="birth" value="{{ isset($particular) ? $particular->birth : old('birth') }}">
        </div>
        <div class="form-group">
            <label for="citizenship">Citizenship:</label>
            <input type="text" class="form-control" name="citizenship" value="{{ isset($particular) ? $particular->citizenship : old('citizenship') }}">
        </div>
        <div class="form-group">
            <label for="marital_status">Marital Status:</label>
            <input type="text" class="form-control" name="marital_status" value="{{ isset($particular) ? $particular->marital_status : old('marital_status') }}">
        </div>
        <div class="form-group">
            <label for="spouse">Spouse:</label>
            <input type="text" class="form-control" name="spouse" value="{{ isset($particular) ? $particular->spouse : old('spouse') }}" placeholder="Not Required">
        </div>
        <div class="form-group">
            <label for="names_ages_of_children">Names and Ages of children:</label>
            <input type="text" class="form-control" name="names_ages_of_children" value="{{ isset($particular) ? $particular->names_ages_of_children : old('names_ages_of_children') }}" placeholder="Not Required">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-success" name="submit" value="{{ isset($particular) ? 'Update' : 'Create' }}">
        </div>
    </form>
    @include('partials.errors')
@endsection