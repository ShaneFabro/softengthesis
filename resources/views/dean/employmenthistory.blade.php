@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.dean')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.dean')

@endsection


@section('content')

    {{-- @if(auth()->user()->employmentHistoryTeachingExperiences()->count() == 0)
    No info 
    <br>
    <a href="{{ route('add.employmenthistory.teachingexperience', auth()->user()->id) }}" class="btn btn-info">Add Employment History for Teaching Experience</a>
    @elseif(auth()->user()->employmentHistoryTeachingExperiences()->count() > 0) --}}
        
    <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-default">
                        <div class="card-header bg-primary">
                            <h3 class="col-md-4">Teaching Experience</h3>
                            <a href="{{ route('add.employmenthistory.teachingexperience') }}" class="btn btn-success float-right">Add</a>
                        </div>
                        <table class="table">
                                <thead>
                                    <th>Institution</th>
                                    <th>Subject Taught</th>
                                    <th>Period of Employment</th>
                                    <th>Academic Rank</th>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->employmentHistoryTeachingExperiences as $employmentHistoryTeachingExperiences)
                                    <tr>
                                        <td>{{ $employmentHistoryTeachingExperiences->institution }}</td>
                                        <td>{{ $employmentHistoryTeachingExperiences->subject_taught }}</td>
                                        <td>
                                            @if($employmentHistoryTeachingExperiences->period_of_employment_from == $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                {{ $employmentHistoryTeachingExperiences->period_of_employment_from }}
                                            @elseif($employmentHistoryTeachingExperiences->period_of_employment_from != $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                {{ $employmentHistoryTeachingExperiences->period_of_employment_from }} - {{ $employmentHistoryTeachingExperiences->period_of_employment_to != null ? $employmentHistoryTeachingExperiences->period_of_employment_to : 'present' }}
                                            @endif
                                        </td>
                                        <td>
                                                @if($employmentHistoryTeachingExperiences->academic_rank == 1)
                                                Instructor I
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 2)
                                                Instructor II
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 3)
                                                Instructor III
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 4)
                                                Instructor IV
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 5)
                                                Instructor V
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 6)
                                                Asst. Professor I
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 7)
                                                Asst. Professor II
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 8)
                                                Asst. Professor III
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 9)
                                                Asst. Professor IV
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 10)
                                                Asst. Professor V
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 11)
                                                Assoc. Professor I
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 12)
                                                Assoc. Professor II
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 13)
                                                Assoc. Professor III
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 14)
                                                Assoc. Professor IV
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 15)
                                                Assoc. Professor V
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 16)
                                                Professor I
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 17)
                                                Professor II
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 18)
                                                Professor III
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 19)
                                                Professor IV
                                            @elseif($employmentHistoryTeachingExperiences->academic_rank == 20)
                                                Professor V
                                            @endif
                                        </td>
                                        <td><a href="{{ route('edit.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" method="POST">
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
                            <h3 class="col-md-4">Administrative Experience</h3>
                            <a href="{{ route('add.employmenthistory.adminisexperience') }}" class="btn btn-success float-right">Add</a>
                        </div>
                        <table class="table">
                                <thead>
                                    <th>Institution</th>
                                    <th>Period of Employment</th>
                                    <th>Position/Title</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->employmentHistoryAdminisExperiences as $employmentHistoryAdminisExperiences)
                                    <tr>
                                        <td>{{ $employmentHistoryAdminisExperiences->institution }}</td>
                                        <td>
                                            @if($employmentHistoryAdminisExperiences->period_of_employment_from == $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                {{ $employmentHistoryAdminisExperiences->period_of_employment_from }}
                                            @elseif($employmentHistoryAdminisExperiences->period_of_employment_from != $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                {{ $employmentHistoryAdminisExperiences->period_of_employment_from }} - {{ $employmentHistoryAdminisExperiences->period_of_employment_to != null ? $employmentHistoryAdminisExperiences->period_of_employment_to : 'present' }}
                                            @endif
                                        </td>
                                        <td>{{ $employmentHistoryAdminisExperiences->position_title }}</td>
                                        <td><a href="{{ route('edit.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
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
                            <h3 class="col-md-4">Professional Practice Outside Teaching</h3>
                            <a href="{{ route('add.employmenthistory.profpracoutteaching') }}" class="btn btn-success float-right">Add</a>
                        </div>
                        <table class="table">
                                <thead>
                                    <th>Institution</th>
                                    <th>Period of Employment</th>
                                    <th>Position/Title</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->employmentHistoryProfPracOutTeaching as $employmentHistoryProfPracOutTeaching)
                                    <tr>
                                        <td>{{ $employmentHistoryProfPracOutTeaching->institution }}</td>
                                        <td>
                                            @if($employmentHistoryProfPracOutTeaching->period_of_employment_from == $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                                {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }}
                                            @elseif($employmentHistoryProfPracOutTeaching->period_of_employment_from != $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                                {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }} - {{ $employmentHistoryProfPracOutTeaching->period_of_employment_to != null ? $employmentHistoryProfPracOutTeaching->period_of_employment_to : 'present' }}
                                            @endif
                                        </td>
                                        <td>{{ $employmentHistoryProfPracOutTeaching->position_title }}</td>
                                        <td><a href="{{ route('edit.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
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
                            <h3 class="col-md-4">Exchange Program</h3>
                            <a href="{{ route('add.employmenthistory.exchangeprogram') }}" class="btn btn-success float-right">Add</a>
                        </div>
                        <table class="table">
                                <thead>
                                    <th>Institution</th>
                                    <th>Inclusive Dates</th>
                                    <th>Position/Title</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->employmentHistoryExchangeProgram as $employmentHistoryExchangeProgram)
                                    <tr>
                                        <td>{{ $employmentHistoryExchangeProgram->institution }}</td>
                                        <td>
                                            @if($employmentHistoryExchangeProgram->inclusive_from == $employmentHistoryExchangeProgram->inclusive_to)
                                                {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }}
                                            @elseif($employmentHistoryExchangeProgram->inclusive_from != $employmentHistoryExchangeProgram->inclusive_to)
                                                {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }} - {{ $employmentHistoryExchangeProgram->inclusive_to != null ? \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_to)->format('M Y') : 'present' }}
                                            @endif
                                        </td>
                                        <td>{{ $employmentHistoryExchangeProgram->position_title }}</td>
                                        <td><a href="{{ route('edit.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
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