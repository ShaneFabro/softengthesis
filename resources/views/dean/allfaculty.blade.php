{{-- @extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You're Logged in as Faculty Member!
                </div>
            </div>
        </div>
    </div>
    <h1>Profile</h1>
    <img src="{{ $user->personalParticulars ? asset('storage/'.$user->personalParticulars->image) : 'http://placehold.it/400x400' }}" alt="">
    <h2>{{ $user->name }}</h2>
    <a href="{{ route('member.edit', $user->username) }}" class="btn btn-success">Edit</a>
        <div class="card-header">Academic Degrees <a href="{{ route('add.academic') }}" class="btn btn-success">Add</a></div>
        <div class="card-body">
            <table class="table">
                @if(auth()->user()->academicDegrees()->count() > 0)
                    <thead>
                        <th>Degree</th>
                        <th>School</th>
                        <th>Yr. Graduated</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($user->academicDegrees as $academic)
                        <tr>
                            <td>{{ $academic->degree }}</td>
                            <td>{{ $academic->school }}</td>
                            <td>{{ $academic->year_graduated }}</td>
                            <td><a href="{{ route('edit.academic', $academic->id) }}" class="btn btn-info">Edit</a></td>
                            <td>
                            <form action="{{ route('delete.academic', $academic->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @else
                    No
                @endif
            </table>
        </div>
        <div class="card-header">Academic Present Status 
            @if(auth()->user()->academicPresentStatus()->count() == 0)
            <a href="{{ route('add.academic.present') }}" class="btn btn-success">Add</a>
            @endif
        </div>
        <div class="card-body">
            <table class="table">
                @if(auth()->user()->academicPresentStatus()->count() > 0)
                    <thead>
                        <th>Academic Rank</th>
                        <th>Employment Status</th>
                        <th>Year First Appointed in UST</th>
                        <th>No. of years in UST</th>
                        <th>Present Position in UST</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->academicPresentStatus->academic_rank }}</td>
                            <td>{{ $user->academicPresentStatus->employment_status }}</td>
                            <td>{{ $user->academicPresentStatus->year_appointed_in_ust }}</td>
                            <td>{{ $user->academicPresentStatus->num_of_years_in_ust }}</td>
                            <td>{{ $user->academicPresentStatus->pos_in_ust }}</td>
                            <td><a href="{{ route('edit.academic.present', $user->academicPresentStatus->id) }}" class="btn btn-info">Edit</a></td>
                            <td>
                            <form action="{{ route('delete.academic.present', $user->academicPresentStatus->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </td>
                        </tr>
                    </tbody>
                @else
                    No
                @endif
            </table>
        </div>
        <div class="card-header">Employment History Teaching Experience<a href="{{ route('add.employmenthistory.teachingexperience') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->employmentHistoryTeachingExperiences()->count() > 0)
                        <thead>
                            <th>Institutions</th>
                            <th>Subject Taught</th>
                            <th>Period of Employment</th>
                            <th>Academic Rank</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->employmentHistoryTeachingExperiences as $employmentHistroiesTeachingExperiences)
                                <td>{{ $employmentHistroiesTeachingExperiences->institution }}</td>
                                <td>{{ $employmentHistroiesTeachingExperiences->subject_taught }}</td>
                                <td>{{ $employmentHistroiesTeachingExperiences->period_of_employment_from }} - {{ $employmentHistroiesTeachingExperiences->period_of_employment_to != null ? $employmentHistroiesTeachingExperiences->period_of_employment_to : 'present' }}</td>
                                <td>{{ $employmentHistroiesTeachingExperiences->academic_rank }}</td>
                                <td><a href="{{ route('edit.employmenthistory.teachingexperience', $employmentHistroiesTeachingExperiences->id) }}" class="btn btn-info">Edit</a></td>
                                <td>
                                <form action="{{ route('delete.employmenthistory.teachingexperience', $employmentHistroiesTeachingExperiences->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
            </div>
            <div class="card-header">Employment History Administrative Experience<a href="{{ route('add.employmenthistory.adminisexperience') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->employmentHistoryAdminisExperiences()->count() > 0)
                        <thead>
                            <th>Institutions</th>
                            <th>Subject Taught</th>
                            <th>Period of Employment</th>
                            <th>Position/Title</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->employmentHistoryAdminisExperiences as $employmentHistoryAdminisExperiences)
                                    <td>{{ $employmentHistoryAdminisExperiences->institution }}</td>
                                    <td>{{ $employmentHistoryAdminisExperiences->subject_taught }}</td>
                                    <td>{{ $employmentHistoryAdminisExperiences->period_of_employment_from }} - {{ $employmentHistoryAdminisExperiences->period_of_employment_to != null ? $employmentHistroiesTeachingExperiences->period_of_employment_to : 'present' }}</td>
                                    <td>{{ $employmentHistoryAdminisExperiences->position_title }}</td>
                                    <td><a href="{{ route('edit.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" class="btn btn-info">Edit</a></td>
                                    <td>
                                    <form action="{{ route('delete.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
            </div>
            <div class="card-header">Employment History Professional Practice Outside Teaching<a href="{{ route('add.employmenthistory.profpracoutteaching') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->employmentHistoryProfPracOutTeaching()->count() > 0)
                        <thead>
                            <th>Institutions</th>
                            <th>Period of Employment</th>
                            <th>Position/Title</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->employmentHistoryProfPracOutTeaching as $employmentHistoryProfPracOutTeaching)
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
                                    <td>
                                    <form action="{{ route('delete.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
            </div>
            <div class="card-header">Employment History Exchange Program<a href="{{ route('add.employmenthistory.exchangeprogram') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->employmentHistoryExchangeProgram()->count() > 0)
                        <thead>
                            <th>Institutions</th>
                            <th>Inclusive Date</th>
                            <th>Position/Title</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->employmentHistoryExchangeProgram as $employmentHistoryExchangeProgram)
                                    <td>{{ $employmentHistoryExchangeProgram->institution }}</td>
                                    <td>{{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }} to {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_to)->format('M Y') }}</td>
                                    <td>{{ $employmentHistoryExchangeProgram->position_title }}</td>
                                    <td><a href="{{ route('edit.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" class="btn btn-info">Edit</a></td>
                                    <td>
                                    <form action="{{ route('delete.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
            </div>
            <div class="card-header">Non-degree training for Non-degree Seminars and Workshops<a href="{{ route('add.nondegree.seminarworkshops') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->nondegreetrainingSeminarsWorkshops()->count() > 0)
                        <thead>
                            <th>Role</th>
                            <th>Title of Seminar/Workshop</th>
                            <th>Venue</th>
                            <th>Inclusive Date</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->nondegreetrainingSeminarsWorkshops as $nondegreetrainingSeminarsWorkshops)
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->role }}</td>
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->seminar_workshop }}</td>
                                    <td>{{ $nondegreetrainingSeminarsWorkshops->venue }}</td>
                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingSeminarsWorkshops->inclusive_date)->format('M d, Y') }}</td>
                                    <td><a href="{{ route('edit.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" class="btn btn-info">Edit</a></td>
                                    <td>
                                    <form action="{{ route('delete.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
            </div>
            <div class="card-header">Non-degree training for Cultural / Educational Travel<a href="{{ route('add.nondegree.culturaleducationaltravel') }}" class="btn btn-success">Add</a></div>
            <div class="card-body">
                <table class="table">
                    @if(auth()->user()->nondegreetrainingCulturalEducationalTravel()->count() > 0)
                        <thead>
                            <th>Role</th>
                            <th>Title of Seminar/Workshop</th>
                            <th>Venue</th>
                            <th>Inclusive Date</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($user->nondegreetrainingCulturalEducationalTravel as $nondegreetrainingCulturalEducationalTravel)
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->role }}</td>
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->seminar_workshop }}</td>
                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->venue }}</td>
                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingCulturalEducationalTravel->inclusive_date)->format('M d, Y') }}</td>
                                    <td><a href="{{ route('edit.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" class="btn btn-info">Edit</a></td>
                                    <td>
                                    <form action="{{ route('delete.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @else
                        No
                    @endif
                </table>
                <div>
                    {!! nl2br($file) !!}
                </div>
            </div>
@endsection
 --}}

 @extends('layouts.inside')

 @section('top-nav-bar')
 
 @include('top-nav-bar.dean')
 
 @endsection
 
 @section('side-nav-bar')
 
 @include('side-nav-bar.deanother')
 
 @endsection
 
 @section('content')
     <h2 class="text-center">All Members</h2>
     <div class="form-group row mt-5">
         <form action="" method="GET">
             <input type="text" name="search" id="" class="form-control col-md-4" placeholder="Search by Name" value="{{ request()->query('search') }}"><i class="fas fa-search"></i>
         </form>
     </div>
     <div class="row justify-content-center">
        <table class="table">
            <thead class="thead-dark">
                <th class="text-center">Name</th>
                <th class="text-center">Role</th>
                <th class="text-center">Department</th>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    @if($member->id == auth()->user()->id)
                        <td class="text-center"><a href="{{ route('dean.index') }}">{{ $member->name }}</a> (You)</td>
                    @else
                        <td class="text-center"><a href="{{ route('dean.show', $member->id) }}">{{ $member->name }}</a></td>
                    @endif
                    <td class="text-center">
                        @if($member->role_id == 2)
                            Faculty Admin
                        @elseif($member->role_id == 3)
                            Faculty Head
                        @elseif($member->role_id == 4)
                            Faculty Member
                        @endif
                    </td>
                    <td class="text-center">
                        @if($member->role_id == 2)
                        @else
                            @if($member->rank_id == 1)
                                English Studies
                            @elseif($member->rank_id == 2)
                                Literatures
                            @elseif($member->rank_id == 3)
                                Philosophy
                            @elseif($member->rank_id == 4)
                                Economics
                            @elseif($member->rank_id == 5)
                                Foreign Language
                            @elseif($member->rank_id == 6)
                                Political Science
                            @elseif($member->rank_id == 7)
                                Sociology
                            @elseif($member->rank_id == 8)
                                History
                            @elseif($member->rank_id == 9)
                                Communication & Media Studies
                            @elseif($member->rank_id == 10)
                                Interdisciplinary
                            @elseif($member->rank_id == 10)
                                Interdisciplinary
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
     </div>
 @endsection