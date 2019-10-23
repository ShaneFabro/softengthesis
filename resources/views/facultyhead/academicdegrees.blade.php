@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.head')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.head')

@endsection

@section('content')
<div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="col-md-4">Academic Degrees</h3>
                        <a href="{{ route('add.academic') }}" class="btn btn-success float-right">Add</a>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Degree</th>
                                <th>School</th>
                                <th>Year Graduated</th>
                                <th></th>
                                <th></th>
                            </thead>
                           
                            <tbody>
                                @foreach(auth()->user()->academicDegrees as $academicDegree)
                                <tr>
                                    <td>{{ $academicDegree->degree }}</td>
                                    <td>{{ $academicDegree->school }}</td>
                                    <td>{{ $academicDegree->year_graduated }}</td>
                                    <td><a href="{{ route('edit.academic', $academicDegree->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.academic', $academicDegree->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection