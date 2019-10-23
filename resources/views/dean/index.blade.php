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
 
 @include('side-nav-bar.dean')
 
 @endsection
 
 @section('content')
     <h2 class="text-center">Curriculum Vitae</h2>
     <div class="container pt-5">
             <div class="row justify-content-center">
                 <div class="col-md-12">
                     <div class="card card-default">
                         <div class="card-header bg-primary">
                             <h3>Personal Particular</h3>
                         </div>
                         @if(auth()->user()->personalParticular()->count() > 0)
                         <div class="row">
                                <div class="card-body ml-4 col-md-5">
                                    <strong>Name:</strong> {{ $user->fullname }}
                                    <br>
                                    <br>
                                    <strong>Sex:</strong> {{ $user->sex == 0 ? 'Male' : 'Female' }}
                                    <br>
                                    <br>
                                    <strong>Religion:</strong> {{ $user->religion }}
                                    <br>
                                    <br>
                                    <strong>Occupation:</strong> {{ $user->occupation }}
                                    <br>
                                    <br>
                                    <strong>Address:</strong> {{ $user->address }}
                                    <br>
                                    <br>
                                    <strong>Age:</strong> {{ $user->age }}
                                    <br>
                                    <br>
                                    <strong>Telephone:</strong> {{ $user->telephone }}
                                    <br>
                                    <br>
                                    <strong>Mobilephone:</strong> {{ $user->mobilephone }}
                                    <br>
                                    <br>
                                    <strong>Email Address:</strong> {{ $user->email }}
                                    <br>
                                    <br>
                                    <strong>Date of Birth:</strong> {{ $user->birth }}
                                    <br>
                                    <br>
                                    <strong>Place of Birth:</strong> {{ $user->place_birth }}
                                    <br>
                                    <br>
                                    <strong>Citizenship:</strong> {{ $user->citizenship }}
                                    <br>
                                    <br>
                                    <strong>Marital Status:</strong> {{ $user->marital_status }}
                                    <br>
                                    <br>
                                    <strong>Name of Spouse:</strong> {{ $user->spouse == null ? 'Not Applicable' : $user->spouse }}
                                    <br>
                                    <br>
                                    <strong>Names and Ages of Children:</strong> {{ $user->names_ages_of_children == null ? 'Not Applicable' : $user->names_ages_of_children }}
                                </div>
                                <div class="col-md-3 col-md-offset-2">
                                    <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://via.placeholder.com/430x400' }}" alt="" width="430" height="400">
                                </div>
                            </div>
                         @else
                             <p class="mt-4 ml-4">Empty Personal Particular</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
         <div class="container pt-5">
             <div class="row justify-content-center">
                 <div class="col-md-12">
                     <div class="card card-default">
                         <div class="card-header bg-primary">
                             <h3>Academic Degrees</h3>
                         </div>
                         @if(auth()->user()->academicDegrees()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Degree</th>
                                     <th>School</th>
                                     <th>Year Graduated</th>
                                 </thead>
                                 <tbody> 
                                     @foreach(auth()->user()->academicDegrees as $academicDegree)
                                     <tr>
                                         <td>{{ $academicDegree->degree }}</td>
                                         <td>{{ $academicDegree->school }}</td>
                                         <td>{{ $academicDegree->year_graduated }}</td>
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         @else
                             <p class="mt-4 ml-4">Empty Academic Degrees</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
         <div class="container pt-5">
             <div class="row justify-content-center">
                 <div class="col-md-12">
                     <div class="card card-default">
                         <div class="card-header bg-primary">
                             <h3>Academic Present Status</h3>
                         </div>
                         @if(auth()->user()->academicPresentStatus()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Academic Rank</th>
                                     <th>Employment Status</th>
                                     <th>Yr. Appointed in UST</th>
                                     <th>No. of years in UST</th>
                                     <th>Present Position in UST</th>
                                 </thead>
                                 <tbody> 
                                     <tr>
                                         <td>
                                                @if(auth()->user()->academicPresentStatus->academic_rank == 1)
                                                Instructor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 2)
                                                Instructor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 3)
                                                Instructor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 4)
                                                Instructor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 5)
                                                Instructor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 6)
                                                Asst. Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 7)
                                                Asst. Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 8)
                                                Asst. Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 9)
                                                Asst. Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 10)
                                                Asst. Professor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 11)
                                                Assoc. Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 12)
                                                Assoc. Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 13)
                                                Assoc. Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 14)
                                                Assoc. Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 15)
                                                Assoc. Professor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 16)
                                                Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 17)
                                                Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 18)
                                                Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 19)
                                                Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 20)
                                                Professor V
                                            @endif
                                         </td>
                                         <td>{{ auth()->user()->academicPresentStatus->employment_status }}</td>
                                         <td>{{ auth()->user()->academicPresentStatus->year_appointed_in_ust }}</td>
                                         <td>{{ auth()->user()->academicPresentStatus->num_of_years_in_ust }}</td>
                                         <td>{{ auth()->user()->academicPresentStatus->pos_in_ust }}</td>
                                     </tr>
                                 </tbody>
                             </table>
                         @else
                             <p class="mt-4 ml-4">Empty Academic Degrees</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
         <div class="container pt-5">
             <div class="row justify-content-center">
                 <div class="col-md-12">
                     <div class="card card-default">
                         <div class="card-header bg-primary">
                             <h3>Employment History</h3>
                         </div>
                         <div class="bg-light">
                             <h4 class="col-sm-6">A. Teaching experience</h4>
                         </div>
                         @if(auth()->user()->employmentHistoryTeachingExperiences()->count() > 0)
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
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         @else
                             <p class="mt-4 ml-4">Empty Employment History for Teching Experience</p>
                         @endif
                         <div class="bg-light">
                             <h4 class="col-sm-6">B. Administrative Experience</h4>
                         </div>
                         @if(auth()->user()->employmentHistoryAdminisExperiences()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Institution</th>
                                     <th>Period of Employment</th>
                                     <th>Position/Title</th>
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
                                     </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         @else
                             <p class="mt-4 ml-4">Empty Employment History for Administrative Experience</p>
                         @endif
                         <div class="bg-light">
                             <h4 class="col-sm-6">C. Professional Practice Outside Teaching</h4>
                         </div>
                         @if(auth()->user()->employmentHistoryProfPracOutTeaching()->count() > 0)
                         <table class="table">
                         <thead>
                             <th>Institution</th>
                             <th>Period of Employment</th>
                             <th>Position/Title</th>
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
                             </tr>
                             @endforeach
                         </tbody>
                         </table>
                         @else
                             <p class="mt-4 ml-4">Empty Employment History for Professional Practice Outside Teaching</p>
                         @endif
                         <div class="bg-light">
                             <h4 class="col-sm-6">D. Exchange Program</h4>
                         </div>
                         @if(auth()->user()->employmentHistoryExchangeProgram()->count() > 0)
                         <table class="table">
                                 <thead>
                                     <th>Institution</th>
                                     <th>Inclusive Dates</th>
                                     <th>Position/Title</th>
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
                                     </tr>
                                     @endforeach
                                 </tbody>
                                 </table>
                         @else
                             <p class="mt-4 ml-4">Empty Employment History for Exchange Program</p>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
         <div class="container pt-5">
                 <div class="row justify-content-center">
                     <div class="col-md-12">
                         <div class="card card-default">
                             <div class="card-header bg-primary">
                                 <h3>Non-Degree Training</h3>
                             </div>
                             <div class="bg-light">
                                 <h4 class="col-sm-6">A. Non-Degree Seminars and Workshops</h4>
                             </div>
                             @if(auth()->user()->nondegreetrainingSeminarsWorkshops()->count() > 0)
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
                                         @endforeach
                                     </tbody>
                                 </table>
                             @else
                                 <p class="mt-4 ml-4">Empty Employment History for Teching Experience</p>
                             @endif
                             <div class="bg-light">
                                 <h4 class="col-sm-6">B. Cultural / Educational Travel</h4>
                             </div>
                             @if(auth()->user()->nondegreetrainingCulturalEducationalTravel()->count() > 0)
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
                                         @endforeach
                                     </tbody>
                                 </table>
                             @else
                                 <p class="mt-4 ml-4">Empty Employment History for Administrative Experience</p>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
             <div class="container pt-5">
                     <div class="row justify-content-center">
                         <div class="col-md-12">
                             <div class="card card-default">
                                 <div class="card-header bg-primary">
                                     <h3>Research And Creative Works</h3>
                                 </div>
                                 <div class="bg-light">
                                     <h4 class="col-md-5">1. Scholarly Productions</h4>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>a. Published articles / researches in reputable journals</strong></p>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">i. Refereed</p>
                                 </div>
                                 @if(auth()->user()->researchScholarPubRefers()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarPubRefers as $researchScholarPubRefers)
                                             <tr>
                                                 <td>{{ $researchScholarPubRefers->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarPubRefers->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarPubRefers->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Refereed Published Articles / Researches in reputable Journals</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">ii. Non-Refereed</p>
                                 </div>
                                 @if(auth()->user()->researchScholarPubNonRefers()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                                 <th>Date of Publication</th>
                                                 <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->researchScholarPubNonRefers as $researchScholarPubNonRefers)
                                                 <tr>
                                                     <td>{{ $researchScholarPubNonRefers->nature_of_publication }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($researchScholarPubNonRefers->date_publication)->format('M Y') }}</td>
                                                     <td>{{ $researchScholarPubNonRefers->role_comments }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Non-Refereed Published Articles / Researches in reputable Journals</p>
                                 @endif
                                 
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>b. Full-Length Books</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarFullBooks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarFullBooks as $researchScholarFullBooks)
                                             <tr>
                                                 <td>{{ $researchScholarFullBooks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarFullBooks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarFullBooks->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Full-Length Books</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>c. Prescribed/Non-prescribed published textbooks – certified by the Dean and the Department Chair</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarPreNonScribePubBooks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarPreNonScribePubBooks as $researchScholarPreNonScribePubBooks)
                                             <tr>
                                                 <td>{{ $researchScholarPreNonScribePubBooks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarPreNonScribePubBooks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarPreNonScribePubBooks->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Prescribed/Non-prescribed published textbooks</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>d. Professional Journal</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarProfJournals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarProfJournals as $researchScholarProfJournals)
                                             <tr>
                                                 <td>{{ $researchScholarProfJournals->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarProfJournals->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarProfJournals->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Professional Journal</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>e. Local Journal</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarLocJournals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarLocJournals as $researchScholarLocJournals)
                                             <tr>
                                                 <td>{{ $researchScholarLocJournals->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarLocJournals->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarLocJournals->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Local Journal</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>f. Delivered & Published Papers/Lectures/Speeches</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarDelPubPaper()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarDelPubPaper as $researchScholarDelPubPaper)
                                             <tr>
                                                 <td>{{ $researchScholarDelPubPaper->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarDelPubPaper->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarDelPubPaper->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Delivered & Published Papers/Lectures/Speeches</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>g. Commissioned and completed researches(e.g. feasibility studies, action research)</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarCommCompResearches()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarCommCompResearches as $researchScholarCommCompResearches)
                                             <tr>
                                                 <td>{{ $researchScholarCommCompResearches->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarCommCompResearches->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarCommCompResearches->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Commissioned and completed researches</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>h. Research Posters</strong></p>
                                 </div>
                                 @if(auth()->user()->researchScholarResearchPosters()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchScholarResearchPosters as $researchScholarResearchPosters)
                                             <tr>
                                                 <td>{{ $researchScholarResearchPosters->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarResearchPosters->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarResearchPosters->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Research Posters</p>
                                 @endif
                                 <div class="bg-light">
                                     <h4 class="col-md-5">2. Creative Works</h4>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>a. Distinguished performance in any of the performing arts</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeDistPerfArts()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeDistPerfArts as $researchCreativeDistPerfArts)
                                             <tr>
                                                 <td>{{ $researchCreativeDistPerfArts->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeDistPerfArts->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeDistPerfArts->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Distinguished performance in any of the performing arts</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>b. Original Musical Work</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeOrigMusicalWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeOrigMusicalWorks as $researchCreativeOrigMusicalWorks)
                                             <tr>
                                                 <td>{{ $researchCreativeOrigMusicalWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeOrigMusicalWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeOrigMusicalWorks->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Original Musical Work</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>c. Original Designs</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreateOrigDesigns()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreateOrigDesigns as $researchCreateOrigDesigns)
                                             <tr>
                                                 <td>{{ $researchCreateOrigDesigns->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreateOrigDesigns->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreateOrigDesigns->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Original Designs</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>d. Published/Acknowledge Literary Works</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeLitWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeLitWorks as $researchCreativeLitWorks)
                                             <tr>
                                                 <td>{{ $researchCreativeLitWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeLitWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeLitWorks->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Published/Acknowledge Literary Works</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>e. Exhibited Art Works</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeExArtWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeExArtWorks as $researchCreativeExArtWorks)
                                             <tr>
                                                 <td>{{ $researchCreativeExArtWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeExArtWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeExArtWorks->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Exhibited Art Works</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>f. Critiques, Position papers published in newspapers of general Circulation</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeGenCirculations()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeGenCirculations as $researchCreativeGenCirculations)
                                             <tr>
                                                 <td>{{ $researchCreativeGenCirculations->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeGenCirculations->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeGenCirculations->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Critiques, Position papers published in newspapers of general Circulation</p>
                                 @endif
                                 <div class="bg-light">
                                     <h4 class="col-md-11">3. Educational Aids and Technology – used by the Department or College and certified by the   Dean of the College, the Department Chair and the Director of the Ed Tech Center</h4>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>a. Material Prodcution(entire course)</strong></p>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">i. Course Modules</p>
                                 </div>
                                 @if(auth()->user()->researchCreativeAidTechMatProdCourseModules()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeAidTechMatProdCourseModules as $researchCreativeAidTechMatProdCourseModules)
                                             <tr>
                                                 <td>{{ $researchCreativeAidTechMatProdCourseModules->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdCourseModules->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdCourseModules->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Course Modules</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">ii. Online Course</p>
                                 </div>
                                 @if(auth()->user()->researchCreativeAidTechMatProdOnlineCourses()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeAidTechMatProdOnlineCourses as $researchCreativeAidTechMatProdOnlineCourses)
                                             <tr>
                                                 <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Online Modules</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">iii. Laboratory manuals, Course manuals or Workbook in actual use by the department or college</p>
                                 </div>
                                 @if(auth()->user()->researchCreativeAidTechMatProdOnlineCourses()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeAidTechMatProdOnlineCourses as $researchCreativeAidTechMatProdOnlineCourses)
                                             <tr>
                                                 <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Laboratory manuals, Course manuals or Workbook in actual use by the department or colleg</p>
                                 @endif
                                 <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>b. Teaching aids produced for use in the department and /or Faculty or College 
                                             (slides, film strips, video( Beta/VHS/CD format) documentation of events, etc. with educational value through any medium and display materials such as models / mobiles / dioramas)</strong></p>
                                 </div>
                                 @if(auth()->user()->researchCreativeAidTechTechAids()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->researchCreativeAidTechTechAids as $researchCreativeAidTechTechAids)
                                             <tr>
                                                 <td>{{ $researchCreativeAidTechTechAids->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechTechAids->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechTechAids->role_comments }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Teaching aids</p>
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="container pt-5">
                         <div class="row justify-content-center">
                             <div class="col-md-12">
                                 <div class="card card-default">
                                     <div class="card-header bg-primary">
                                         <h3>Community Extension Service</h3>
                                     </div>
                                     <div class="bg-light">
                                         <h4 class="col-md-5">1. Community Service</h4>
                                     </div>
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>a. Community Development</strong></p>
                                     </div>
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">i. University-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceDevUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceDevUnivInitiates as $commExtServiceCommServiceDevUnivInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceDevUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceDevUnivInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Community Development for University-Initiated</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">ii. Externally-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceDevExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceDevExtInitiates as $commExtServiceCommServiceDevExtInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Community Development for Externally-Initiated</p>
                                     @endif
                                     
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>b. Humanitarian/Relief Mission</strong></p>
                                     </div>
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">i. University-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceHumanUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceHumanUnivInitiates as $commExtServiceCommServiceHumanUnivInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Humanitarian/Relief Mission for University-Initiated</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">ii. Externally-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceHumanExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceHumanExtInitiates as $commExtServiceCommServiceHumanExtInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanExtInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanExtInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Humanitarian/Relief Mission for Externally-Initiated</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>c. Involvement in Advocacy Activities</strong></p>
                                     </div>
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">i. University-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceAdvoUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceAdvoUnivInitiates as $commExtServiceCommServiceAdvoUnivInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Involvement in Advocacy Activities for University-Initiated</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-md-offset-2">ii. Externally-Initiated</p>
                                     </div>
                                     @if(auth()->user()->commExtServiceCommServiceAdvoExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->commExtServiceCommServiceAdvoExtInitiates as $commExtServiceCommServiceAdvoExtInitiates)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoExtInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoExtInitiates->role }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Involvement in Advocacy Activities for Externally-Initiated</p>
                                     @endif
                                 <div class="bg-light">
                                     <h4 class="col-md-5">2. Extension Service</h4>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>a. Seminars/Workshops/Conferences/Convention</strong></p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceSeminars()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Date</th>
                                             <th>Title/Nature of Activities / Services</th>
                                             <th>Role/Participation</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceSeminars as $commExtserviceExtserviceSeminars)
                                             <tr>
                                                 <td>{{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_to)->format('M d Y') }}</td>
                                                 <td>{{ $commExtserviceExtserviceSeminars->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceSeminars->role }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Seminars/Workshops/Conferences/Convention</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>b. Professional standing, Recognition and Achievements</strong></p>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">i. International Officership / Membership in Professional Organizations</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceProfStandOffInternationals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceProfStandOffInternationals as $commExtserviceExtserviceProfStandOffInternationals)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffInternationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffInternationals->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty International Officership / Membership in Professional Organizations</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">ii. National Officership / Membership in Professional Organizations</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceProfStandOffNationals()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceProfStandOffNationals as $commExtserviceExtserviceProfStandOffNationals)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffNationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffNationals->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty National Officership / Membership in Professional Organizations</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">iii. International Officership / Membership in Academic Organizations</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceProfStandOffAcadInternationals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceProfStandOffAcadInternationals as $commExtserviceExtserviceProfStandOffAcadInternationals)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty International Officership / Membership in Academic Organizations</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">iv. National Officership / Membership in Academic Organizations</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceProfStandOffAcadNationals()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceProfStandOffAcadNationals as $commExtserviceExtserviceProfStandOffAcadNationals)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty National Officership / Membership in Academic Organizations</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>c. Managerial Work</strong></p>
                                 </div>
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">i. Government</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceManWorkGovernments()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceManWorkGovernments as $commExtserviceExtserviceManWorkGovernments)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkGovernments->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkGovernments->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Government</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">ii. Private</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceManWorkPrivates()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceManWorkPrivates as $commExtserviceExtserviceManWorkPrivates)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkPrivates->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkPrivates->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Private</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-md-offset-2">iii. Senior Partner in a nationally recognized professional partnership</p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceManWorkSeniors()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceManWorkSeniors as $commExtserviceExtserviceManWorkSeniors)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkSeniors->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkSeniors->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Senior Partner in a nationally recognized professional partnership</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>d. Consultancy Work</strong></p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceConsultWorks()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceConsultWorks as $commExtserviceExtserviceConsultWorks)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceConsultWorks->inclusive_years_from }} - {{ $commExtserviceExtserviceConsultWorks->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceConsultWorks->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceConsultWorks->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Consultancy Work</p>
                                 @endif
                                 <div class="bg-light">
                                     <p class="col-sm-offset-1" style="color: black"><strong>e. Guest appearance or Feature in media on a topic related to expertise</strong></p>
                                 </div>
                                 @if(auth()->user()->commExtserviceExtserviceGuestAppearances()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                         </thead>
                                         <tbody> 
                                             @foreach(auth()->user()->commExtserviceExtserviceGuestAppearances as $commExtserviceExtserviceGuestAppearances)
                                             <tr>
                                                 <td>{{ $commExtserviceExtserviceGuestAppearances->inclusive_years_from }} - {{ $commExtserviceExtserviceGuestAppearances->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceGuestAppearances->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceGuestAppearances->position }}</td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 @else
                                     <p class="mt-4 ml-4">Empty Guest appearance or Feature in media on a topic related to expertise</p>
                                 @endif
                             </div>
                         </div>
                     </div>
                     <div class="container pt-5">
                         <div class="row justify-content-center">
                             <div class="col-md-12">
                                 <div class="card card-default">
                                     <div class="card-header bg-primary">
                                         <h3>Scholarships , Honors And/Or Awards Received</h3>
                                     </div>
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>a. Government Examination passed, if any:</strong></p>
                                     </div>
                                     @if(auth()->user()->honorsReceivedGovernments()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Nature of Government Examination</th>
                                                 <th>Status (Grade)</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->honorsReceivedGovernments as $honorsReceivedGovernments)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedGovernments->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedGovernments->grade }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Government Examination passed</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>b. Scholarships, if any:</strong></p>
                                     </div>
                                     @if(auth()->user()->honorsReceivedScholarships()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Nature of Scholarship</th>
                                                 <th>Status (Grade)</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->honorsReceivedScholarships as $honorsReceivedScholarships)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedScholarships->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedScholarships->grade }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Scholarships</p>
                                     @endif
                                     <div class="bg-light">
                                         <p class="col-sm-offset-1" style="color: black"><strong>c. Awards(professional and/or academic honors received):</strong></p>
                                     </div>
                                     @if(auth()->user()->honorsReceivedAwards()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Awarding Organization</th>
                                                 <th>Status (Grade)</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->honorsReceivedAwards as $honorsReceivedAwards)
                                                 <tr>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedAwards->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedAwards->grade }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Scholarships</p>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div> 
                     <div class="container pt-5">
                         <div class="row justify-content-center">
                             <div class="col-md-12">
                                 <div class="card card-default">
                                     <div class="card-header bg-primary">
                                         <h3>Use of Information Technology in Instructional Delivery</h3>
                                     </div>
                                     @if(auth()->user()->useOfTechnologies()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>List of Subjects Taught</th>
                                                 <th>Do you use IT-based instructional aid in teaching the subject?</th>
                                                 <th>If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.)</th>
                                             </thead>
                                             <tbody> 
                                                 @foreach(auth()->user()->useOfTechnologies as $useOfTechnologies)
                                                 <tr>
                                                     <td>{{ $useOfTechnologies->subjects_taught }}</td>
                                                     <td>{{ $useOfTechnologies->yes_no }}</td>
                                                     <td>{{ $useOfTechnologies->nature_it_used }}</td>
                                                 </tr>
                                                 @endforeach
                                             </tbody>
                                         </table>
                                     @else
                                         <p class="mt-4 ml-4">Empty Use of Information Technology in Instructional Delivery</p>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>
 @endsection