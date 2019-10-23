@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.dean')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.deanother')

@endsection
 
@section('content')
     <h2 class="text-center">
            @if($user->role_id == 2)
            Faculty Admin <strong>{{ $user->name }}</strong>
            @else
            Faculty @if($user->role_id == 4) Member @elseif($user->role_id == 3) Head @elseif($user->role_id == 2) Head @endif <strong>{{ empty($user->personalParticular->fullname) ? $user->name : $user->personalParticular->fullname }}</strong> of {{ $user->rank->name }}
            @endif
     </h2>
     <div class="container pt-5">
             <div class="row justify-content-center">
                 <div class="col-md-12">
                     <div class="card card-default">
                         <div class="card-header bg-primary">
                             <h3>Personal Particular</h3>
                         </div>
                         @if($user->personalParticular()->count() > 0)
                         <div class="row">
                                <div class="card-body ml-4 col-md-5">
                                    <strong>Name:</strong> {{ $user->personalParticular->fullname }}
                                    <br>
                                    <br>
                                    <strong>Sex:</strong> {{ $user->personalParticular->sex == 0 ? 'Male' : 'Female' }}
                                    <br>
                                    <br>
                                    <strong>Religion:</strong> {{ $user->personalParticular->religion }}
                                    <br>
                                    <br>
                                    <strong>Occupation:</strong> {{ $user->personalParticular->occupation }}
                                    <br>
                                    <br>
                                    <strong>Address:</strong> {{ $user->personalParticular->address }}
                                    <br>
                                    <br>
                                    <strong>Age:</strong> {{ $user->personalParticular->age }}
                                    <br>
                                    <br>
                                    <strong>Telephone:</strong> {{ $user->personalParticular->telephone }}
                                    <br>
                                    <br>
                                    <strong>Mobilephone:</strong> {{ $user->personalParticular->mobilephone }}
                                    <br>
                                    <br>
                                    <strong>Email Address:</strong> {{ $user->personalParticular->email }}
                                    <br>
                                    <br>
                                    <strong>Date of Birth:</strong> {{ $user->personalParticular->birth }}
                                    <br>
                                    <br>
                                    <strong>Place of Birth:</strong> {{ $user->personalParticular->place_birth }}
                                    <br>
                                    <br>
                                    <strong>Citizenship:</strong> {{ $user->personalParticular->citizenship }}
                                    <br>
                                    <br>
                                    <strong>Marital Status:</strong> {{ $user->personalParticular->marital_status }}
                                    <br>
                                    <br>
                                    <strong>Name of Spouse:</strong> {{ $user->personalParticular->spouse == null ? 'Not Applicable' : $user->personalParticular->spouse }}
                                    <br>
                                    <br>
                                    <strong>Names and Ages of Children:</strong> {{ $user->names_ages_of_children == null ? 'Not Applicable' : $user->names_ages_of_children }}
                                </div>
                                <div class="col-md-3 col-md-offset-2">
                                    <img src="{{ $user->photo_id != null ? asset('images/' . $user->photo->file) : 'https://via.placeholder.com/430x400' }}" alt="" width="430" height="400">
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
                         @if($user->academicDegrees()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Degree</th>
                                     <th>School</th>
                                     <th>Year Graduated</th>
                                 </thead>
                                 <tbody> 
                                     @foreach($user->academicDegrees as $academicDegree)
                                     <tr>
                                         @if($user->role_id == 3)
                                            <td>{{ $academicDegree->degree }}</td>
                                            <td>{{ $academicDegree->school }}</td>
                                            <td>{{ $academicDegree->year_graduated }}</td>
                                                @if($academicDegree->validate == 0)
                                                    <form action="{{ route('approveorunapprove.academic', $academicDegree->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                @else
                                                    <form action="{{ route('approveorunapprove.academic', $academicDegree->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif
                                         @elseif($user->role_id == 4)
                                                @if($academicDegree->validate == 1)
                                                    <td>{{ $academicDegree->degree }}</td>
                                                    <td>{{ $academicDegree->school }}</td>
                                                    <td>{{ $academicDegree->year_graduated }}</td>
                                                @endif
                                         @endif
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
                         @if($user->academicPresentStatus()->count() > 0)
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
                                         {{-- <td>{{ $user->academicPresentStatus->academic_rank }}</td>
                                         <td>{{ $user->academicPresentStatus->employment_status }}</td>
                                         <td>{{ $user->academicPresentStatus->year_appointed_in_ust }}</td>
                                         <td>{{ $user->academicPresentStatus->num_of_years_in_ust }}</td>
                                         <td>{{ $user->academicPresentStatus->pos_in_ust }}</td>
                                         @if($user->academicPresentStatus->validate == 0)
                                            <form action="{{ route('approveorunapprove.academic.present', $user->academicPresentStatus->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                         @else
                                            <form action="{{ route('approveorunapprove.academic.present', $user->academicPresentStatus->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                         @endif --}}
                                         @if($user->role_id == 3)
                                            <td>
                                                @if($user->academicPresentStatus->academic_rank == 1)
                                                    Instructor I
                                                @elseif($user->academicPresentStatus->academic_rank == 2)
                                                    Instructor II
                                                @elseif($user->academicPresentStatus->academic_rank == 3)
                                                    Instructor III
                                                @elseif($user->academicPresentStatus->academic_rank == 4)
                                                    Instructor IV
                                                @elseif($user->academicPresentStatus->academic_rank == 5)
                                                    Instructor V
                                                @elseif($user->academicPresentStatus->academic_rank == 6)
                                                    Asst. Professor I
                                                @elseif($user->academicPresentStatus->academic_rank == 7)
                                                    Asst. Professor II
                                                @elseif($user->academicPresentStatus->academic_rank == 8)
                                                    Asst. Professor III
                                                @elseif($user->academicPresentStatus->academic_rank == 9)
                                                    Asst. Professor IV
                                                @elseif($user->academicPresentStatus->academic_rank == 10)
                                                    Asst. Professor V
                                                @elseif($user->academicPresentStatus->academic_rank == 11)
                                                    Assoc. Professor I
                                                @elseif($user->academicPresentStatus->academic_rank == 12)
                                                    Assoc. Professor II
                                                @elseif($user->academicPresentStatus->academic_rank == 13)
                                                    Assoc. Professor III
                                                @elseif($user->academicPresentStatus->academic_rank == 14)
                                                    Assoc. Professor IV
                                                @elseif($user->academicPresentStatus->academic_rank == 15)
                                                    Assoc. Professor V
                                                @elseif($user->academicPresentStatus->academic_rank == 16)
                                                    Professor I
                                                @elseif($user->academicPresentStatus->academic_rank == 17)
                                                    Professor II
                                                @elseif($user->academicPresentStatus->academic_rank == 18)
                                                    Professor III
                                                @elseif($user->academicPresentStatus->academic_rank == 19)
                                                    Professor IV
                                                @elseif($user->academicPresentStatus->academic_rank == 20)
                                                    Professor V
                                                @endif
                                            </td>
                                            <td>{{ $user->academicPresentStatus->employment_status }}</td>
                                            <td>{{ $user->academicPresentStatus->year_appointed_in_ust }}</td>
                                            <td>{{ $user->academicPresentStatus->num_of_years_in_ust }}</td>
                                            <td>{{ $user->academicPresentStatus->pos_in_ust }}</td>
                                                @if($user->academicPresentStatus->validate == 0)
                                                    <form action="{{ route('approveorunapprove.academic.present', $user->academicPresentStatus->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                @else
                                                    <form action="{{ route('approveorunapprove.academic.present', $user->academicPresentStatus->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif
                                         @elseif($user->role_id == 4)
                                                @if($user->academicPresentStatus->validate == 1)
                                                    <td>
                                                            @if($user->academicPresentStatus->academic_rank == 1)
                                                            Instructor I
                                                        @elseif($user->academicPresentStatus->academic_rank == 2)
                                                            Instructor II
                                                        @elseif($user->academicPresentStatus->academic_rank == 3)
                                                            Instructor III
                                                        @elseif($user->academicPresentStatus->academic_rank == 4)
                                                            Instructor IV
                                                        @elseif($user->academicPresentStatus->academic_rank == 5)
                                                            Instructor V
                                                        @elseif($user->academicPresentStatus->academic_rank == 6)
                                                            Asst. Professor I
                                                        @elseif($user->academicPresentStatus->academic_rank == 7)
                                                            Asst. Professor II
                                                        @elseif($user->academicPresentStatus->academic_rank == 8)
                                                            Asst. Professor III
                                                        @elseif($user->academicPresentStatus->academic_rank == 9)
                                                            Asst. Professor IV
                                                        @elseif($user->academicPresentStatus->academic_rank == 10)
                                                            Asst. Professor V
                                                        @elseif($user->academicPresentStatus->academic_rank == 11)
                                                            Assoc. Professor I
                                                        @elseif($user->academicPresentStatus->academic_rank == 12)
                                                            Assoc. Professor II
                                                        @elseif($user->academicPresentStatus->academic_rank == 13)
                                                            Assoc. Professor III
                                                        @elseif($user->academicPresentStatus->academic_rank == 14)
                                                            Assoc. Professor IV
                                                        @elseif($user->academicPresentStatus->academic_rank == 15)
                                                            Assoc. Professor V
                                                        @elseif($user->academicPresentStatus->academic_rank == 16)
                                                            Professor I
                                                        @elseif($user->academicPresentStatus->academic_rank == 17)
                                                            Professor II
                                                        @elseif($user->academicPresentStatus->academic_rank == 18)
                                                            Professor III
                                                        @elseif($user->academicPresentStatus->academic_rank == 19)
                                                            Professor IV
                                                        @elseif($user->academicPresentStatus->academic_rank == 20)
                                                            Professor V
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->academicPresentStatus->employment_status }}</td>
                                                    <td>{{ $user->academicPresentStatus->year_appointed_in_ust }}</td>
                                                    <td>{{ $user->academicPresentStatus->num_of_years_in_ust }}</td>
                                                    <td>{{ $user->academicPresentStatus->pos_in_ust }}</td>
                                                @endif
                                         @endif
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
                         @if($user->employmentHistoryTeachingExperiences()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Institution</th>
                                     <th>Subject Taught</th>
                                     <th>Period of Employment</th>
                                     <th>Academic Rank</th>
                                     
                                 </thead>
                                 <tbody> 
                                     @foreach($user->employmentHistoryTeachingExperiences as $employmentHistoryTeachingExperiences)
                                     <tr>
                                     {{-- <tr>
                                         <td>{{ $employmentHistoryTeachingExperiences->institution }}</td>
                                         <td>{{ $employmentHistoryTeachingExperiences->subject_taught }}</td>
                                         <td>
                                             @if($employmentHistoryTeachingExperiences->period_of_employment_from == $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryTeachingExperiences->period_of_employment_from }}
                                             @elseif($employmentHistoryTeachingExperiences->period_of_employment_from != $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryTeachingExperiences->period_of_employment_from }} - {{ $employmentHistoryTeachingExperiences->period_of_employment_to != null ? $employmentHistoryTeachingExperiences->period_of_employment_to : 'present' }}
                                             @endif
                                         </td>
                                         <td>{{ $employmentHistoryTeachingExperiences->academic_rank }}</td>
                                         @if($employmentHistoryTeachingExperiences->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                         @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                         @endif --}}
                                         @if($user->role_id == 3)
                                         <td>{{ $employmentHistoryTeachingExperiences->institution }}</td>
                                         <td>{{ $employmentHistoryTeachingExperiences->subject_taught }}</td>
                                         <td>
                                             @if($employmentHistoryTeachingExperiences->period_of_employment_from == $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryTeachingExperiences->period_of_employment_from }}
                                             @elseif($employmentHistoryTeachingExperiences->period_of_employment_from != $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryTeachingExperiences->period_of_employment_from }} - {{ $employmentHistoryTeachingExperiences->period_of_employment_to != null ? $employmentHistoryTeachingExperiences->period_of_employment_to : 'present' }}
                                             @endif
                                         </td>
                                         <td>@if($employmentHistoryTeachingExperiences->academic_rank == 1)
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
                                            @endif</td>
                                         @if($employmentHistoryTeachingExperiences->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                         @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.teachingexperience', $employmentHistoryTeachingExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                         @endif
                                            @elseif($user->role_id == 4)
                                                @if($employmentHistoryTeachingExperiences->validate == 1)
                                                <td>{{ $employmentHistoryTeachingExperiences->institution }}</td>
                                                <td>{{ $employmentHistoryTeachingExperiences->subject_taught }}</td>
                                                <td>
                                                    @if($employmentHistoryTeachingExperiences->period_of_employment_from == $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                        {{ $employmentHistoryTeachingExperiences->period_of_employment_from }}
                                                    @elseif($employmentHistoryTeachingExperiences->period_of_employment_from != $employmentHistoryTeachingExperiences->period_of_employment_to)
                                                        {{ $employmentHistoryTeachingExperiences->period_of_employment_from }} - {{ $employmentHistoryTeachingExperiences->period_of_employment_to != null ? $employmentHistoryTeachingExperiences->period_of_employment_to : 'present' }}
                                                    @endif
                                                </td>
                                                <td>{{ $employmentHistoryTeachingExperiences->academic_rank }}</td>
                                                @endif
                                            @endif
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
                         @if($user->employmentHistoryAdminisExperiences()->count() > 0)
                             <table class="table">
                                 <thead>
                                     <th>Institution</th>
                                     <th>Period of Employment</th>
                                     <th>Position/Title</th>
                                     
                                 </thead>
                                 <tbody> 
                                     @foreach($user->employmentHistoryAdminisExperiences as $employmentHistoryAdminisExperiences)
                                     <tr>
                                         {{-- <td>{{ $employmentHistoryAdminisExperiences->institution }}</td>
                                         <td>
                                             @if($employmentHistoryAdminisExperiences->period_of_employment_from == $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryAdminisExperiences->period_of_employment_from }}
                                             @elseif($employmentHistoryAdminisExperiences->period_of_employment_from != $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryAdminisExperiences->period_of_employment_from }} - {{ $employmentHistoryAdminisExperiences->period_of_employment_to != null ? $employmentHistoryAdminisExperiences->period_of_employment_to : 'present' }}
                                             @endif
                                         </td>
                                         <td>{{ $employmentHistoryAdminisExperiences->position_title }}</td>
                                         @if($employmentHistoryAdminisExperiences->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                         @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                         @endif --}}
                                         @if($user->role_id == 3)
                                         <td>{{ $employmentHistoryAdminisExperiences->institution }}</td>
                                         <td>
                                             @if($employmentHistoryAdminisExperiences->period_of_employment_from == $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryAdminisExperiences->period_of_employment_from }}
                                             @elseif($employmentHistoryAdminisExperiences->period_of_employment_from != $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                 {{ $employmentHistoryAdminisExperiences->period_of_employment_from }} - {{ $employmentHistoryAdminisExperiences->period_of_employment_to != null ? $employmentHistoryAdminisExperiences->period_of_employment_to : 'present' }}
                                             @endif
                                         </td>
                                         <td>{{ $employmentHistoryAdminisExperiences->position_title }}</td>
                                         @if($employmentHistoryAdminisExperiences->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                         @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.adminisexperience', $employmentHistoryAdminisExperiences->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                         @endif
                                            @elseif($user->role_id == 4)
                                                @if($employmentHistoryAdminisExperiences->validate == 1)
                                                <td>{{ $employmentHistoryAdminisExperiences->institution }}</td>
                                                <td>
                                                @if($employmentHistoryAdminisExperiences->period_of_employment_from == $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                    {{ $employmentHistoryAdminisExperiences->period_of_employment_from }}
                                                @elseif($employmentHistoryAdminisExperiences->period_of_employment_from != $employmentHistoryAdminisExperiences->period_of_employment_to)
                                                    {{ $employmentHistoryAdminisExperiences->period_of_employment_from }} - {{ $employmentHistoryAdminisExperiences->period_of_employment_to != null ? $employmentHistoryAdminisExperiences->period_of_employment_to : 'present' }}
                                                @endif
                                                </td>
                                                <td>{{ $employmentHistoryAdminisExperiences->position_title }}</td>
                                                @endif
                                            @endif
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
                         @if($user->employmentHistoryProfPracOutTeaching()->count() > 0)
                         <table class="table">
                         <thead>
                             <th>Institution</th>
                             <th>Period of Employment</th>
                             <th>Position/Title</th>
                             
                         </thead>
                         <tbody> 
                             @foreach($user->employmentHistoryProfPracOutTeaching as $employmentHistoryProfPracOutTeaching)
                             <tr>
                                 {{-- <td>{{ $employmentHistoryProfPracOutTeaching->institution }}</td>
                                 <td>
                                     @if($employmentHistoryProfPracOutTeaching->period_of_employment_from == $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                         {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }}
                                     @elseif($employmentHistoryProfPracOutTeaching->period_of_employment_from != $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                         {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }} - {{ $employmentHistoryProfPracOutTeaching->period_of_employment_to != null ? $employmentHistoryProfPracOutTeaching->period_of_employment_to : 'present' }}
                                     @endif
                                 </td>
                                 <td>{{ $employmentHistoryProfPracOutTeaching->position_title }}</td>
                                 @if($employmentHistoryProfPracOutTeaching->validate == 0)
                                    <form action="{{ route('approveorunapprove.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                    </form>
                                    @else
                                    <form action="{{ route('approveorunapprove.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                    </form>
                                @endif --}}
                                @if($user->role_id == 3)
                                <td>{{ $employmentHistoryProfPracOutTeaching->institution }}</td>
                                <td>
                                    @if($employmentHistoryProfPracOutTeaching->period_of_employment_from == $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                        {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }}
                                    @elseif($employmentHistoryProfPracOutTeaching->period_of_employment_from != $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                        {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }} - {{ $employmentHistoryProfPracOutTeaching->period_of_employment_to != null ? $employmentHistoryProfPracOutTeaching->period_of_employment_to : 'present' }}
                                    @endif
                                    </td>
                                    <td>{{ $employmentHistoryProfPracOutTeaching->position_title }}</td>
                                    @if($employmentHistoryProfPracOutTeaching->validate == 0)
                                    <form action="{{ route('approveorunapprove.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                    </form>
                                    @else
                                    <form action="{{ route('approveorunapprove.employmenthistory.profpracoutteaching', $employmentHistoryProfPracOutTeaching->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                    </form>
                                    @endif
                                    @elseif($user->role_id == 4)
                                        @if($employmentHistoryProfPracOutTeaching->validate == 1)
                                        <td>{{ $employmentHistoryProfPracOutTeaching->institution }}</td>
                                        <td>
                                            @if($employmentHistoryProfPracOutTeaching->period_of_employment_from == $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                                {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }}
                                            @elseif($employmentHistoryProfPracOutTeaching->period_of_employment_from != $employmentHistoryProfPracOutTeaching->period_of_employment_to)
                                                {{ $employmentHistoryProfPracOutTeaching->period_of_employment_from }} - {{ $employmentHistoryProfPracOutTeaching->period_of_employment_to != null ? $employmentHistoryProfPracOutTeaching->period_of_employment_to : 'present' }}
                                            @endif
                                        </td>
                                        <td>{{ $employmentHistoryProfPracOutTeaching->position_title }}</td>
                                        @endif
                                    @endif
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
                         @if($user->employmentHistoryExchangeProgram()->count() > 0)
                         <table class="table">
                                 <thead>
                                     <th>Institution</th>
                                     <th>Inclusive Dates</th>
                                     <th>Position/Title</th>
                                     
                                 </thead>
                                 <tbody> 
                                     @foreach($user->employmentHistoryExchangeProgram as $employmentHistoryExchangeProgram)
                                     <tr>
                                         {{-- <td>{{ $employmentHistoryExchangeProgram->institution }}</td>
                                         <td>
                                             @if($employmentHistoryExchangeProgram->inclusive_from == $employmentHistoryExchangeProgram->inclusive_to)
                                                 {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }}
                                             @elseif($employmentHistoryExchangeProgram->inclusive_from != $employmentHistoryExchangeProgram->inclusive_to)
                                                 {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }} - {{ $employmentHistoryExchangeProgram->inclusive_to != null ? \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_to)->format('M Y') : 'present' }}
                                             @endif
                                         </td>
                                         <td>{{ $employmentHistoryExchangeProgram->position_title }}</td>
                                         @if($employmentHistoryExchangeProgram->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                            @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                        @endif --}}
                                        @if($user->role_id == 3)
                                        <td>{{ $employmentHistoryExchangeProgram->institution }}</td>
                                         <td>
                                             @if($employmentHistoryExchangeProgram->inclusive_from == $employmentHistoryExchangeProgram->inclusive_to)
                                                 {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }}
                                             @elseif($employmentHistoryExchangeProgram->inclusive_from != $employmentHistoryExchangeProgram->inclusive_to)
                                                 {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }} - {{ $employmentHistoryExchangeProgram->inclusive_to != null ? \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_to)->format('M Y') : 'present' }}
                                             @endif
                                         </td>
                                         <td>{{ $employmentHistoryExchangeProgram->position_title }}</td>
                                         @if($employmentHistoryExchangeProgram->validate == 0)
                                            <form action="{{ route('approveorunapprove.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                            </form>
                                            @else
                                            <form action="{{ route('approveorunapprove.employmenthistory.exchangeprogram', $employmentHistoryExchangeProgram->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                            </form>
                                        @endif
                                            @elseif($user->role_id == 4)
                                                @if($employmentHistoryExchangeProgram->validate == 1)
                                                <td>{{ $employmentHistoryExchangeProgram->institution }}</td>
                                                <td>
                                                    @if($employmentHistoryExchangeProgram->inclusive_from == $employmentHistoryExchangeProgram->inclusive_to)
                                                        {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }}
                                                    @elseif($employmentHistoryExchangeProgram->inclusive_from != $employmentHistoryExchangeProgram->inclusive_to)
                                                        {{ \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_from)->format('M Y') }} - {{ $employmentHistoryExchangeProgram->inclusive_to != null ? \Carbon\Carbon::parse($employmentHistoryExchangeProgram->inclusive_to)->format('M Y') : 'present' }}
                                                    @endif
                                                </td>
                                                <td>{{ $employmentHistoryExchangeProgram->position_title }}</td>
                                                @endif
                                        @endif
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
                             @if($user->nondegreetrainingSeminarsWorkshops()->count() > 0)
                                 <table class="table">
                                     <thead>
                                         <th>Role</th>
                                         <th>Title of Seminar / Workshop</th>
                                         <th>Venue</th>
                                         <th>Inclusive Date</th>
                                         
                                     </thead>
                                     <tbody> 
                                         @foreach($user->nondegreetrainingSeminarsWorkshops as $nondegreetrainingSeminarsWorkshops)
                                         <tr>
                                             {{-- <td>{{ $nondegreetrainingSeminarsWorkshops->role }}</td>
                                             <td>{{ $nondegreetrainingSeminarsWorkshops->seminar_workshop }}</td>
                                             <td>{{ $nondegreetrainingSeminarsWorkshops->venue }}</td>
                                             <td>{{ \Carbon\Carbon::parse($nondegreetrainingSeminarsWorkshops->inclusive_date)->format('M d Y') }}</td>
                                            @if($nondegreetrainingSeminarsWorkshops->validate == 0)
                                                <form action="{{ route('approveorunapprove.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                </form>
                                                @else
                                                <form action="{{ route('approveorunapprove.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                </form>
                                            @endif --}}
                                            @if($user->role_id == 3)
                                                    <td>{{ $nondegreetrainingSeminarsWorkshops->role }}</td>
                                                    <td>{{ $nondegreetrainingSeminarsWorkshops->seminar_workshop }}</td>
                                                    <td>{{ $nondegreetrainingSeminarsWorkshops->venue }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingSeminarsWorkshops->inclusive_date)->format('M d Y') }}</td>
                                                @if($nondegreetrainingSeminarsWorkshops->validate == 0)
                                                    <form action="{{ route('approveorunapprove.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.nondegree.seminarworkshops', $nondegreetrainingSeminarsWorkshops->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif
                                                
                                                    @elseif($user->role_id == 4)
                                                        @if($nondegreetrainingSeminarsWorkshops->validate == 1)
                                                        <td>{{ $nondegreetrainingSeminarsWorkshops->role }}</td>
                                                        <td>{{ $nondegreetrainingSeminarsWorkshops->seminar_workshop }}</td>
                                                        <td>{{ $nondegreetrainingSeminarsWorkshops->venue }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($nondegreetrainingSeminarsWorkshops->inclusive_date)->format('M d Y') }}</td>
                                                        @endif
                                                @endif
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
                             @if($user->nondegreetrainingCulturalEducationalTravel()->count() > 0)
                                 <table class="table">
                                     <thead>
                                         <th>Role</th>
                                         <th>Title of Seminar / Workshop</th>
                                         <th>Venue</th>
                                         <th>Inclusive Date</th>
                                         
                                     </thead>
                                     <tbody> 
                                         @foreach($user->nondegreetrainingCulturalEducationalTravel as $nondegreetrainingCulturalEducationalTravel)
                                         <tr>
                                             {{-- <td>{{ $nondegreetrainingCulturalEducationalTravel->role }}</td>
                                             <td>{{ $nondegreetrainingCulturalEducationalTravel->seminar_workshop }}</td>
                                             <td>{{ $nondegreetrainingCulturalEducationalTravel->venue }}</td>
                                             <td>{{ \Carbon\Carbon::parse($nondegreetrainingCulturalEducationalTravel->inclusive_date)->format('M d Y') }}</td>
                                             @if($nondegreetrainingCulturalEducationalTravel->validate == 0)
                                                <form action="{{ route('approveorunapprove.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                </form>
                                                @else
                                                <form action="{{ route('approveorunapprove.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                </form>
                                            @endif --}}
                                            @if($user->role_id == 3)
                                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->role }}</td>
                                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->seminar_workshop }}</td>
                                                    <td>{{ $nondegreetrainingCulturalEducationalTravel->venue }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($nondegreetrainingCulturalEducationalTravel->inclusive_date)->format('M d Y') }}</td>
                                                    @if($nondegreetrainingCulturalEducationalTravel->validate == 0)
                                                    <form action="{{ route('approveorunapprove.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.nondegree.culturaleducationaltravel', $nondegreetrainingCulturalEducationalTravel->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif
                                                
                                                
                                                    @elseif($user->role_id == 4)
                                                        @if($nondegreetrainingCulturalEducationalTravel->validate == 1)
                                                        <td>{{ $nondegreetrainingCulturalEducationalTravel->role }}</td>
                                                        <td>{{ $nondegreetrainingCulturalEducationalTravel->seminar_workshop }}</td>
                                                        <td>{{ $nondegreetrainingCulturalEducationalTravel->venue }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($nondegreetrainingCulturalEducationalTravel->inclusive_date)->format('M d Y') }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarPubRefers()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarPubRefers as $researchScholarPubRefers)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarPubRefers->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarPubRefers->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarPubRefers->role_comments }}</td>
                                                 @if($researchScholarPubRefers->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                @if($user->role_id == 3)
                                                    <td>{{ $researchScholarPubRefers->nature_of_publication }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($researchScholarPubRefers->date_publication)->format('M Y') }}</td>
                                                    <td>{{ $researchScholarPubRefers->role_comments }}</td>
                                                    @if($researchScholarPubRefers->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    </form>
                                                @endif
                                                    @elseif($user->role_id == 4)
                                                        @if($researchScholarPubRefers->validate == 1)
                                                        <td>{{ $researchScholarPubRefers->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarPubRefers->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarPubRefers->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarPubNonRefers()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                                 <th>Date of Publication</th>
                                                 <th>Role/comments (e.g. author/co-author, etc.)</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->researchScholarPubNonRefers as $researchScholarPubNonRefers)
                                                 <tr>
                                                     {{-- <td>{{ $researchScholarPubNonRefers->nature_of_publication }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($researchScholarPubNonRefers->date_publication)->format('M Y') }}</td>
                                                     <td>{{ $researchScholarPubNonRefers->role_comments }}</td>
                                                     @if($researchScholarPubNonRefers->validate == 0)
                                                        <form action="{{ route('approveorunapprove.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                    @endif --}}
                                                    @if($user->role_id == 3)
                                                            <td>{{ $researchScholarPubNonRefers->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarPubNonRefers->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarPubNonRefers->role_comments }}</td>
                                                            @if($researchScholarPubNonRefers->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                           <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                    @elseif($user->role_id == 4)
                                                            @if($researchScholarPubNonRefers->validate == 1)
                                                            <td>{{ $researchScholarPubNonRefers->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarPubNonRefers->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarPubNonRefers->role_comments }}</td>
                                                            @endif
                                                    @endif
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
                                 @if($user->researchScholarFullBooks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarFullBooks as $researchScholarFullBooks)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarFullBooks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarFullBooks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarFullBooks->role_comments }}</td>
                                                 @if($researchScholarFullBooks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.fullbook', $researchScholarFullBooks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.fullbook', $researchScholarFullBooks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarFullBooks->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarFullBooks->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarFullBooks->role_comments }}</td>
                                                            @if($researchScholarFullBooks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.fullbook', $researchScholarFullBooks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.fullbook', $researchScholarFullBooks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarFullBooks->validate == 1)
                                                        <td>{{ $researchScholarFullBooks->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarFullBooks->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarFullBooks->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarPreNonScribePubBooks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarPreNonScribePubBooks as $researchScholarPreNonScribePubBooks)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarPreNonScribePubBooks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarPreNonScribePubBooks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarPreNonScribePubBooks->role_comments }}</td>
                                                 @if($researchScholarPreNonScribePubBooks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarPreNonScribePubBooks->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarPreNonScribePubBooks->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarPreNonScribePubBooks->role_comments }}</td>
                                                            @if($researchScholarPreNonScribePubBooks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarPreNonScribePubBooks->validate == 1)
                                                        <td>{{ $researchScholarPreNonScribePubBooks->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarPreNonScribePubBooks->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarPreNonScribePubBooks->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarProfJournals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarProfJournals as $researchScholarProfJournals)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarProfJournals->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarProfJournals->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarProfJournals->role_comments }}</td>
                                                 @if($researchScholarProfJournals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.profjournal', $researchScholarProfJournals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.profjournal', $researchScholarProfJournals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarProfJournals->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarProfJournals->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarProfJournals->role_comments }}</td>
                                                            @if($researchScholarProfJournals->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.profjournal', $researchScholarProfJournals->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.profjournal', $researchScholarProfJournals->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarProfJournals->validate == 1)
                                                        <td>{{ $researchScholarProfJournals->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarProfJournals->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarProfJournals->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarLocJournals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarLocJournals as $researchScholarLocJournals)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarLocJournals->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarLocJournals->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarLocJournals->role_comments }}</td>
                                                 @if($researchScholarLocJournals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.locjournal', $researchScholarLocJournals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.locjournal', $researchScholarLocJournals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarLocJournals->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarLocJournals->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarLocJournals->role_comments }}</td>
                                                            @if($researchScholarLocJournals->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.locjournal', $researchScholarLocJournals->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.locjournal', $researchScholarLocJournals->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarLocJournals->validate == 1)
                                                        <td>{{ $researchScholarLocJournals->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarLocJournals->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarLocJournals->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarDelPubPaper()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarDelPubPaper as $researchScholarDelPubPaper)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarDelPubPaper->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarDelPubPaper->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarDelPubPaper->role_comments }}</td>
                                                 @if($researchScholarDelPubPaper->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarDelPubPaper->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarDelPubPaper->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarDelPubPaper->role_comments }}</td>
                                                            @if($researchScholarDelPubPaper->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarDelPubPaper->validate == 1)
                                                        <td>{{ $researchScholarDelPubPaper->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarDelPubPaper->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarDelPubPaper->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarCommCompResearches()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarCommCompResearches as $researchScholarCommCompResearches)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarCommCompResearches->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarCommCompResearches->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarCommCompResearches->role_comments }}</td>
                                                 @if($researchScholarCommCompResearches->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarCommCompResearches->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarCommCompResearches->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarCommCompResearches->role_comments }}</td>
                                                            @if($researchScholarCommCompResearches->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarCommCompResearches->validate == 1)
                                                        <td>{{ $researchScholarCommCompResearches->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarCommCompResearches->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarCommCompResearches->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchScholarResearchPosters()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchScholarResearchPosters as $researchScholarResearchPosters)
                                             <tr>
                                                 {{-- <td>{{ $researchScholarResearchPosters->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchScholarResearchPosters->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchScholarResearchPosters->role_comments }}</td>
                                                 @if($researchScholarResearchPosters->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchScholarResearchPosters->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchScholarResearchPosters->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchScholarResearchPosters->role_comments }}</td>
                                                            @if($researchScholarResearchPosters->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchScholarResearchPosters->validate == 1)
                                                        <td>{{ $researchScholarResearchPosters->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchScholarResearchPosters->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchScholarResearchPosters->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeDistPerfArts()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeDistPerfArts as $researchCreativeDistPerfArts)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeDistPerfArts->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeDistPerfArts->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeDistPerfArts->role_comments }}</td>
                                                 @if($researchCreativeDistPerfArts->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreativeDistPerfArts->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreativeDistPerfArts->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreativeDistPerfArts->role_comments }}</td>
                                                            @if($researchCreativeDistPerfArts->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeDistPerfArts->validate == 1)
                                                        <td>{{ $researchCreativeDistPerfArts->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeDistPerfArts->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeDistPerfArts->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeOrigMusicalWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeOrigMusicalWorks as $researchCreativeOrigMusicalWorks)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeOrigMusicalWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeOrigMusicalWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeOrigMusicalWorks->role_comments }}</td>
                                                 @if($researchCreativeOrigMusicalWorks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreativeOrigMusicalWorks->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreativeOrigMusicalWorks->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreativeOrigMusicalWorks->role_comments }}</td>
                                                            @if($researchCreativeOrigMusicalWorks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeOrigMusicalWorks->validate == 1)
                                                        <td>{{ $researchCreativeOrigMusicalWorks->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeOrigMusicalWorks->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeOrigMusicalWorks->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreateOrigDesigns()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreateOrigDesigns as $researchCreateOrigDesigns)
                                             <tr>
                                                 {{-- <td>{{ $researchCreateOrigDesigns->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreateOrigDesigns->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreateOrigDesigns->role_comments }}</td>
                                                 @if($researchCreateOrigDesigns->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreateOrigDesigns->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreateOrigDesigns->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreateOrigDesigns->role_comments }}</td>
                                                            @if($researchCreateOrigDesigns->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreateOrigDesigns->validate == 1)
                                                        <td>{{ $researchCreateOrigDesigns->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreateOrigDesigns->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreateOrigDesigns->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeLitWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeLitWorks as $researchCreativeLitWorks)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeLitWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeLitWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeLitWorks->role_comments }}</td>
                                                 @if($researchCreativeLitWorks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.litwork', $researchCreativeLitWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.litwork', $researchCreativeLitWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                
                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreativeLitWorks->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreativeLitWorks->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreativeLitWorks->role_comments }}</td>
                                                            @if($researchCreativeLitWorks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.litwork', $researchCreativeLitWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.litwork', $researchCreativeLitWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeLitWorks->validate == 1)
                                                        <td>{{ $researchCreativeLitWorks->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeLitWorks->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeLitWorks->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeExArtWorks()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeExArtWorks as $researchCreativeExArtWorks)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeExArtWorks->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeExArtWorks->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeExArtWorks->role_comments }}</td>
                                                 @if($researchCreativeExArtWorks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreativeExArtWorks->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreativeExArtWorks->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreativeExArtWorks->role_comments }}</td>
                                                            @if($researchCreativeExArtWorks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeExArtWorks->validate == 1)
                                                        <td>{{ $researchCreativeExArtWorks->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeExArtWorks->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeExArtWorks->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeGenCirculations()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeGenCirculations as $researchCreativeGenCirculations)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeGenCirculations->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeGenCirculations->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeGenCirculations->role_comments }}</td>
                                                 @if($researchCreativeGenCirculations->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $researchCreativeGenCirculations->nature_of_publication }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($researchCreativeGenCirculations->date_publication)->format('M Y') }}</td>
                                                            <td>{{ $researchCreativeGenCirculations->role_comments }}</td>
                                                            @if($researchCreativeGenCirculations->validate == 0)
                                                            <form action="{{ route('approveorunapprove.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeGenCirculations->validate == 1)
                                                        <td>{{ $researchCreativeGenCirculations->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeGenCirculations->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeGenCirculations->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeAidTechMatProdCourseModules()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeAidTechMatProdCourseModules as $researchCreativeAidTechMatProdCourseModules)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeAidTechMatProdCourseModules->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdCourseModules->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdCourseModules->role_comments }}</td>
                                                 @if($researchCreativeAidTechMatProdCourseModules->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                    <td>{{ $researchCreativeAidTechMatProdCourseModules->nature_of_publication }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdCourseModules->date_publication)->format('M Y') }}</td>
                                                    <td>{{ $researchCreativeAidTechMatProdCourseModules->role_comments }}</td>
                                                    @if($researchCreativeAidTechMatProdCourseModules->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeAidTechMatProdCourseModules->validate == 1)
                                                        <td>{{ $researchCreativeAidTechMatProdCourseModules->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdCourseModules->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeAidTechMatProdCourseModules->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeAidTechMatProdOnlineCourses()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeAidTechMatProdOnlineCourses as $researchCreativeAidTechMatProdOnlineCourses)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                                                 @if($researchCreativeAidTechMatProdOnlineCourses->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                    <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                                                    <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                                                    @if($researchCreativeAidTechMatProdOnlineCourses->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeAidTechMatProdOnlineCourses->validate == 1)
                                                        <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeAidTechMatProdManuals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeAidTechMatProdManuals as $researchCreativeAidTechMatProdManuals)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeAidTechMatProdManuals->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdManuals->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechMatProdManuals->role_comments }}</td>
                                                 @if($researchCreativeAidTechMatProdManuals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                    <td>{{ $researchCreativeAidTechMatProdManuals->nature_of_publication }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdManuals->date_publication)->format('M Y') }}</td>
                                                    <td>{{ $researchCreativeAidTechMatProdManuals->role_comments }}</td>
                                                    @if($researchCreativeAidTechMatProdManuals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeAidTechMatProdManuals->validate == 1)
                                                        <td>{{ $researchCreativeAidTechMatProdManuals->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdManuals->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeAidTechMatProdManuals->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                 @if($user->researchCreativeAidTechTechAids()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Nature of publication (book/textbook, journal article, newspaper article, research publication)</th>
                                             <th>Date of Publication</th>
                                             <th>Role/comments (e.g. author/co-author, etc.)</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->researchCreativeAidTechTechAids as $researchCreativeAidTechTechAids)
                                             <tr>
                                                 {{-- <td>{{ $researchCreativeAidTechTechAids->nature_of_publication }}</td>
                                                 <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechTechAids->date_publication)->format('M Y') }}</td>
                                                 <td>{{ $researchCreativeAidTechTechAids->role_comments }}</td>
                                                 @if($researchCreativeAidTechTechAids->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                    <td>{{ $researchCreativeAidTechTechAids->nature_of_publication }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechTechAids->date_publication)->format('M Y') }}</td>
                                                    <td>{{ $researchCreativeAidTechTechAids->role_comments }}</td>
                                                    @if($researchCreativeAidTechTechAids->validate == 0)
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    @endif
                                                @elseif($user->role_id == 4)
                                                        @if($researchCreativeAidTechTechAids->validate == 1)
                                                        <td>{{ $researchCreativeAidTechTechAids->nature_of_publication }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechTechAids->date_publication)->format('M Y') }}</td>
                                                        <td>{{ $researchCreativeAidTechTechAids->role_comments }}</td>
                                                        @endif
                                                @endif
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
                                     @if($user->commExtServiceCommServiceDevUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceDevUnivInitiates as $commExtServiceCommServiceDevUnivInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceDevUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceDevUnivInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceDevUnivInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                    <td>{{ $commExtServiceCommServiceDevUnivInitiates->title}}</td>
                                                    <td>{{ $commExtServiceCommServiceDevUnivInitiates->role }}</td>
                                                    @if($commExtServiceCommServiceDevUnivInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                    @endif
                                                @elseif($user->role_id == 4)
                                                        @if($commExtServiceCommServiceDevUnivInitiates->validate == 1)
                                                        <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                        <td>{{ $commExtServiceCommServiceDevUnivInitiates->title}}</td>
                                                        <td>{{ $commExtServiceCommServiceDevUnivInitiates->role }}</td>
                                                        @endif
                                                @endif
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
                                     @if($user->commExtServiceCommServiceDevExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceDevExtInitiates as $commExtServiceCommServiceDevExtInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceDevExtInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceDevExtInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceDevExtInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                    @if($user->role_id == 3)
                                                        <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                        <td>{{ $commExtServiceCommServiceDevExtInitiates->title}}</td>
                                                        <td>{{ $commExtServiceCommServiceDevExtInitiates->role }}</td>
                                                        @if($commExtServiceCommServiceDevExtInitiates->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                    @elseif($user->role_id == 4)
                                                            @if($commExtServiceCommServiceDevExtInitiates->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceDevExtInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceDevExtInitiates->role }}</td>
                                                            @endif
                                                    @endif
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
                                     @if($user->commExtServiceCommServiceHumanUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceHumanUnivInitiates as $commExtServiceCommServiceHumanUnivInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceHumanUnivInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}
                                                @if($user->role_id == 3)
                                                        <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                        <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                                        <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                                        @if($commExtServiceCommServiceHumanUnivInitiates->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtServiceCommServiceHumanUnivInitiates->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->commExtServiceCommServiceHumanExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceHumanExtInitiates as $commExtServiceCommServiceHumanExtInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanExtInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceHumanExtInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceHumanExtInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanExtInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanExtInitiates->role }}</td>
                                                            @if($commExtServiceCommServiceHumanExtInitiates->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtServiceCommServiceHumanExtInitiates->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanExtInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceHumanExtInitiates->role }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->commExtServiceCommServiceAdvoUnivInitiates()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceAdvoUnivInitiates as $commExtServiceCommServiceAdvoUnivInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceAdvoUnivInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->role }}</td>
                                                            @if($commExtServiceCommServiceAdvoUnivInitiates->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtServiceCommServiceAdvoUnivInitiates->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->role }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->commExtServiceCommServiceAdvoExtInitiates()->count() > 0)
                                     <table class="table">
                                             <thead>
                                                 <th>Inclusive Date</th>
                                                 <th>Title/Nature of Activities / Services</th>
                                                 <th>Role/Participation</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->commExtServiceCommServiceAdvoExtInitiates as $commExtServiceCommServiceAdvoExtInitiates)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoExtInitiates->title}}</td>
                                                     <td>{{ $commExtServiceCommServiceAdvoExtInitiates->role }}</td>
                                                     @if($commExtServiceCommServiceAdvoExtInitiates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoExtInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoExtInitiates->role }}</td>
                                                            @if($commExtServiceCommServiceAdvoExtInitiates->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtServiceCommServiceAdvoExtInitiates->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoExtInitiates->title}}</td>
                                                            <td>{{ $commExtServiceCommServiceAdvoExtInitiates->role }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceSeminars()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Date</th>
                                             <th>Title/Nature of Activities / Services</th>
                                             <th>Role/Participation</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceSeminars as $commExtserviceExtserviceSeminars)
                                             <tr>
                                                 {{-- <td>{{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_to)->format('M d Y') }}</td>
                                                 <td>{{ $commExtserviceExtserviceSeminars->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceSeminars->role }}</td>
                                                 @if($commExtserviceExtserviceSeminars->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                        <td>{{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_to)->format('M d Y') }}</td>
                                                        <td>{{ $commExtserviceExtserviceSeminars->title}}</td>
                                                        <td>{{ $commExtserviceExtserviceSeminars->role }}</td>
                                                        @if($commExtserviceExtserviceSeminars->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceSeminars->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_to)->format('M d Y') }}</td>
                                                            <td>{{ $commExtserviceExtserviceSeminars->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceSeminars->role }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceProfStandOffInternationals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceProfStandOffInternationals as $commExtserviceExtserviceProfStandOffInternationals)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffInternationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffInternationals->position }}</td>
                                                 @if($commExtserviceExtserviceProfStandOffInternationals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_to }}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->title}}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->position }}</td>
                                                        @if($commExtserviceExtserviceProfStandOffInternationals->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceProfStandOffInternationals->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffInternationals->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffInternationals->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceProfStandOffNationals()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceProfStandOffNationals as $commExtserviceExtserviceProfStandOffNationals)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffNationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffNationals->position }}</td>
                                                 @if($commExtserviceExtserviceProfStandOffNationals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_to }}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->title}}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->position }}</td>
                                                        @if($commExtserviceExtserviceProfStandOffNationals->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceProfStandOffNationals->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffNationals->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffNationals->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceProfStandOffAcadInternationals()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceProfStandOffAcadInternationals as $commExtserviceExtserviceProfStandOffAcadInternationals)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->position }}</td>
                                                 @if($commExtserviceExtserviceProfStandOffAcadInternationals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_to }}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->title}}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->position }}</td>
                                                        @if($commExtserviceExtserviceProfStandOffAcadInternationals->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceProfStandOffAcadInternationals->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceProfStandOffAcadNationals()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceProfStandOffAcadNationals as $commExtserviceExtserviceProfStandOffAcadNationals)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->position }}</td>
                                                 @if($commExtserviceExtserviceProfStandOffAcadNationals->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_to }}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->title}}</td>
                                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->position }}</td>
                                                        @if($commExtserviceExtserviceProfStandOffAcadNationals->validate == 0)
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('approveorunapprove.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                        </form>
                                                        @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceProfStandOffAcadNationals->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceManWorkGovernments()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceManWorkGovernments as $commExtserviceExtserviceManWorkGovernments)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkGovernments->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkGovernments->position }}</td>
                                                 @if($commExtserviceExtserviceManWorkGovernments->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->position }}</td>
                                                            @if($commExtserviceExtserviceManWorkGovernments->validate == 0)
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceManWorkGovernments->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkGovernments->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceManWorkPrivates()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceManWorkPrivates as $commExtserviceExtserviceManWorkPrivates)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkPrivates->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkPrivates->position }}</td>
                                                 @if($commExtserviceExtserviceManWorkPrivates->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->position }}</td>
                                                            @if($commExtserviceExtserviceManWorkPrivates->validate == 0)
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceManWorkPrivates->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkPrivates->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceManWorkSeniors()->count() > 0)
                                     <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceManWorkSeniors as $commExtserviceExtserviceManWorkSeniors)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkSeniors->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceManWorkSeniors->position }}</td>
                                                 @if($commExtserviceExtserviceManWorkSeniors->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->position }}</td>
                                                            @if($commExtserviceExtserviceManWorkSeniors->validate == 0)
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceManWorkSeniors->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceManWorkSeniors->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceConsultWorks()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceConsultWorks as $commExtserviceExtserviceConsultWorks)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceConsultWorks->inclusive_years_from }} - {{ $commExtserviceExtserviceConsultWorks->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceConsultWorks->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceConsultWorks->position }}</td>
                                                 @if($commExtserviceExtserviceConsultWorks->validate == 0)
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('approveorunapprove.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->inclusive_years_from }} - {{ $commExtserviceExtserviceConsultWorks->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->position }}</td>
                                                            @if($commExtserviceExtserviceConsultWorks->validate == 0)
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('approveorunapprove.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceConsultWorks->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->inclusive_years_from }} - {{ $commExtserviceExtserviceConsultWorks->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceConsultWorks->position }}</td>
                                                            @endif
                                                @endif
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
                                 @if($user->commExtserviceExtserviceGuestAppearances()->count() > 0)
                                 <table class="table">
                                         <thead>
                                             <th>Inclusive Years</th>
                                             <th>Title/Nature of Document</th>
                                             <th>Title/Position</th>
                                             
                                         </thead>
                                         <tbody> 
                                             @foreach($user->commExtserviceExtserviceGuestAppearances as $commExtserviceExtserviceGuestAppearances)
                                             <tr>
                                                 {{-- <td>{{ $commExtserviceExtserviceGuestAppearances->inclusive_years_from }} - {{ $commExtserviceExtserviceGuestAppearances->inclusive_years_to }}</td>
                                                 <td>{{ $commExtserviceExtserviceGuestAppearances->title}}</td>
                                                 <td>{{ $commExtserviceExtserviceGuestAppearances->position }}</td>
                                                 @if($commExtserviceExtserviceGuestAppearances->validate == 0)
                                                    <form action="{{ route('updaapproveorunapprovete.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('updaapproveorunapprovete.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->inclusive_years_from }} - {{ $commExtserviceExtserviceGuestAppearances->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->position }}</td>
                                                            @if($commExtserviceExtserviceGuestAppearances->validate == 0)
                                                            <form action="{{ route('updaapproveorunapprovete.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('updaapproveorunapprovete.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($commExtserviceExtserviceGuestAppearances->validate == 1)
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->inclusive_years_from }} - {{ $commExtserviceExtserviceGuestAppearances->inclusive_years_to }}</td>
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->title}}</td>
                                                            <td>{{ $commExtserviceExtserviceGuestAppearances->position }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->honorsReceivedGovernments()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Nature of Government Examination</th>
                                                 <th>Status (Grade)</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->honorsReceivedGovernments as $honorsReceivedGovernments)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedGovernments->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedGovernments->grade }}</td>
                                                     @if($honorsReceivedGovernments->validate == 0)
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.government', $honorsReceivedGovernments->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.government', $honorsReceivedGovernments->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                                <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->from)->format('M Y') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->to)->format('M Y') }}</td>
                                                                <td>{{ $honorsReceivedGovernments->nature_gov_exam }}</td>
                                                                <td>{{ $honorsReceivedGovernments->grade }}</td>
                                                                @if($honorsReceivedGovernments->validate == 0)
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.government', $honorsReceivedGovernments->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.government', $honorsReceivedGovernments->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($honorsReceivedGovernments->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->from)->format('M Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedGovernments->to)->format('M Y') }}</td>
                                                            <td>{{ $honorsReceivedGovernments->nature_gov_exam }}</td>
                                                            <td>{{ $honorsReceivedGovernments->grade }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->honorsReceivedScholarships()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Nature of Scholarship</th>
                                                 <th>Status (Grade)</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->honorsReceivedScholarships as $honorsReceivedScholarships)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedScholarships->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedScholarships->grade }}</td>
                                                     @if($honorsReceivedScholarships->validate == 0)
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->from)->format('M Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->to)->format('M Y') }}</td>
                                                            <td>{{ $honorsReceivedScholarships->nature_gov_exam }}</td>
                                                            <td>{{ $honorsReceivedScholarships->grade }}</td>
                                                            @if($honorsReceivedScholarships->validate == 0)
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.scholarship', $honorsReceivedScholarships->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($honorsReceivedScholarships->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->from)->format('M Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedScholarships->to)->format('M Y') }}</td>
                                                            <td>{{ $honorsReceivedScholarships->nature_gov_exam }}</td>
                                                            <td>{{ $honorsReceivedScholarships->grade }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->honorsReceivedAwards()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>From</th>
                                                 <th>To</th>
                                                 <th>Awarding Organization</th>
                                                 <th>Status (Grade)</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->honorsReceivedAwards as $honorsReceivedAwards)
                                                 <tr>
                                                     {{-- <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->from)->format('M Y') }}</td>
                                                     <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->to)->format('M Y') }}</td>
                                                     <td>{{ $honorsReceivedAwards->nature_gov_exam }}</td>
                                                     <td>{{ $honorsReceivedAwards->grade }}</td>
                                                     @if($honorsReceivedAwards->validate == 0)
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.award', $honorsReceivedAwards->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('updaapproveorunapprovete.honorsreceived.award', $honorsReceivedAwards->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->from)->format('M Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->to)->format('M Y') }}</td>
                                                            <td>{{ $honorsReceivedAwards->nature_gov_exam }}</td>
                                                            <td>{{ $honorsReceivedAwards->grade }}</td>
                                                            @if($honorsReceivedAwards->validate == 0)
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.award', $honorsReceivedAwards->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('updaapproveorunapprovete.honorsreceived.award', $honorsReceivedAwards->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($honorsReceivedAwards->validate == 1)
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->from)->format('M Y') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($honorsReceivedAwards->to)->format('M Y') }}</td>
                                                            <td>{{ $honorsReceivedAwards->nature_gov_exam }}</td>
                                                            <td>{{ $honorsReceivedAwards->grade }}</td>
                                                            @endif
                                                @endif
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
                                     @if($user->useOfTechnologies()->count() > 0)
                                         <table class="table">
                                             <thead>
                                                 <th>List of Subjects Taught</th>
                                                 <th>Do you use IT-based instructional aid in teaching the subject?</th>
                                                 <th>If yes, indicate nature of IT aid used (Internet, eleap. Powerpoint, etc.)</th>
                                                 
                                             </thead>
                                             <tbody> 
                                                 @foreach($user->useOfTechnologies as $useOfTechnologies)
                                                 <tr>
                                                     {{-- <td>{{ $useOfTechnologies->sbujects_taught }}</td>
                                                     <td>{{ $useOfTechnologies->yes_no }}</td>
                                                     <td>{{ $useOfTechnologies->nature_it_used }}</td>
                                                     @if($useOfTechnologies->validate == 0)
                                                    <form action="{{ route('updaapproveorunapprovete.useoftechnology', $useOfTechnologies->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                    </form>
                                                    @else
                                                    <form action="{{ route('updaapproveorunapprovete.useoftechnology', $useOfTechnologies->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                    </form>
                                                @endif --}}

                                                @if($user->role_id == 3)
                                                                <td>{{ $useOfTechnologies->sbujects_taught }}</td>
                                                                <td>{{ $useOfTechnologies->yes_no }}</td>
                                                                <td>{{ $useOfTechnologies->nature_it_used }}</td>
                                                                @if($useOfTechnologies->validate == 0)
                                                            <form action="{{ route('updaapproveorunapprovete.useoftechnology', $useOfTechnologies->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-success" value="Approve"></td>
                                                            </form>
                                                            @else
                                                            <form action="{{ route('updaapproveorunapprovete.useoftechnology', $useOfTechnologies->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <td><input type="submit" class="btn btn-danger" value="Unapprove"></td>
                                                            </form>
                                                            @endif
                                                @elseif($user->role_id == 4)
                                                            @if($useOfTechnologies->validate == 1)
                                                            <td>{{ $useOfTechnologies->subjects_taught }}</td>
                                                            <td>{{ $useOfTechnologies->yes_no }}</td>
                                                            <td>{{ $useOfTechnologies->nature_it_used }}</td>
                                                            @endif
                                                @endif
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