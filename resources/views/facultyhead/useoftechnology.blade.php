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
                        <a href="{{ route('add.useoftechnology') }}" class="btn btn-success float-right">Add</a>
                        <h3 class="col-md-10">Use of Information Technology in Instructional Delivery</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <th>List of Subjects Taught</th>
                            <th>Do you use IT-based instructional aid in teaching the subject?</th>
                            <th>If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.)</th>
                            <th></th>
                            <th></th>
                        </thead>    
                        <tbody>
                            <tbody>
                                @foreach(auth()->user()->useOfTechnologies as $useOfTechnologies)
                                <tr>
                                    <td>{{ $useOfTechnologies->subjects_taught }}</td>
                                    <td>{{ $useOfTechnologies->yes_no }}</td>
                                    <td>{{ $useOfTechnologies->nature_it_used }}</td>
                                    <td><a href="{{ route('edit.useoftechnology', $useOfTechnologies->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.useoftechnology', $useOfTechnologies->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection