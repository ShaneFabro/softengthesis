@extends('layouts.inside')

@section('top-nav-bar')

@include('top-nav-bar.member')

@endsection
    
@section('side-nav-bar')

@include('side-nav-bar.member')

@endsection
@section('content')
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header bg-primary">
                    <h3 class="col-md-10">Scholarships, Honors and/or Awards Received</h3>
                </div>
                <div class="bg-light">
                    <a href="{{ route('add.honorsreceived.government') }}" class="btn btn-success float-right">Add</a>
                    <p class="col-md-offset-1" style="color: black">a. Government Examinations passed, if any:</p>
                </div>
                <table class="table">
                    <thead>
                        <th>From</th>
                        <th>To</th>
                        <th>Nature of Government Examination</th>
                        <th>Status (Grade)</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach(auth()->user()->honorsReceivedGovernments as $honorsReceivedGovernments)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->from)->format('M d Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->to)->format('M d Y') }}</td>
                                <td>{{ $honorsReceivedGovernments->nature_gov_exam }}</td>
                                <td>{{ $honorsReceivedGovernments->grade }}</td>
                                <td><a href="{{ route('edit.honorsreceived.government', $honorsReceivedGovernments->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.honorsreceived.government', $honorsReceivedGovernments->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                       
                    </tbody>
                </table>
                <div class="bg-light">
                    <a href="{{ route('add.honorsreceived.scholarship') }}" class="btn btn-success float-right">Add</a>
                    <p class="col-md-offset-1" style="color: black">b. Scholarships, if any:</p>
                </div>
                <table class="table">
                    <thead>
                        <th>From</th>
                        <th>To</th>
                        <th>Nature of Scholarship</th>
                        <th>Status (Grade)</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach(auth()->user()->honorsReceivedScholarships as $honorsReceivedScholarships)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->from)->format('M d Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->to)->format('M d Y') }}</td>
                                <td>{{ $honorsReceivedScholarships->nature_gov_exam }}</td>
                                <td>{{ $honorsReceivedScholarships->grade }}</td>
                                <td><a href="{{ route('edit.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </tbody>
                </table>
                <div class="bg-light">
                    <a href="{{ route('add.honorsreceived.award') }}" class="btn btn-success float-right">Add</a>
                    <p class="col-md-offset-1" style="color: black">c. Awards (professional and/or academic honors received):</p>
                </div>
                <table class="table">
                    <thead>
                        <th>From</th>
                        <th>To</th>
                        <th>Awarding Organization</th>
                        <th>Status (Grade)</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody> 
                        <tbody>
                            @foreach(auth()->user()->honorsReceivedAwards as $honorsReceivedAwards)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->from)->format('M d Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->to)->format('M d Y') }}</td>
                                <td>{{ $honorsReceivedAwards->nature_gov_exam }}</td>
                                <td>{{ $honorsReceivedAwards->grade }}</td>
                                <td><a href="{{ route('edit.honorsreceived.award', $honorsReceivedAwards->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.honorsreceived.award', $honorsReceivedAwards->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </tbody>
                </table>
@endsection