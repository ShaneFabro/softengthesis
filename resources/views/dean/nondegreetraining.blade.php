@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.dean')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.dean')

@endsection


@section('content')
<div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="col-md-4">Non-Degree Seminars and Workshops</h3>
                        <a href="{{ route('add.nondegree.seminarworkshops') }}" class="btn btn-success float-right">Add</a>
                    </div>
                    <table class="table">
                        <thead>
                                <th>Role</th>
                                <th>Title of Seminar / Workshop</th>
                                <th>Venue</th>
                                <th>Inclusive Date</th>
                            </thead>
                            <tbody> 
                                @foreach(auth()->user()->nondegreetrainingSeminarsWorkshops as $nondegreetrainingSeminarsWorkshops)
                                <tr>
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->role }}</td>
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->seminar_workshop }}</td>
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->venue }}</td>
                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingSeminarsWorkshops->inclusive_date)->format('M d Y') }}</td>
                                </tr>
                                <td><a href="{{ route('edit.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
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
    
<div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="col-md-4">Cultural / Educational Travel</h3>
                        <a href="{{ route('add.nondegree.culturaleducationaltravel') }}" class="btn btn-success float-right">Add</a>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Role</th>
                                <th>Title of Seminar / Workshop</th>
                                <th>Venue</th>
                                <th>Inclusive Date</th>
                            </thead>
                            <tbody> 
                                @foreach(auth()->user()->nondegreetrainingCulturalEducationalTravel as $nondegreetrainingCulturalEducationalTravel)
                                <tr>
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->role }}</td>
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->seminar_workshop }}</td>
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->venue }}</td>
                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingCulturalEducationalTravel->inclusive_date)->format('M d Y') }}</td>
                                </tr>
                                <td><a href="{{ route('edit.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
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