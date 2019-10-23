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
                @if($user->academicDegrees()->count() > 0)
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
            @if($user->academicPresentStatus()->count() == 0)
            <a href="{{ route('add.academic.present') }}" class="btn btn-success">Add</a>
            @endif
        </div>
        <div class="card-body">
            <table class="table">
                @if($user->academicPresentStatus()->count() > 0)
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
                    @if($user->employmentHistoryTeachingExperiences()->count() > 0)
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
                    @if($user->employmentHistoryAdminisExperiences()->count() > 0)
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
                    @if($user->employmentHistoryProfPracOutTeaching()->count() > 0)
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
                    @if($user->employmentHistoryExchangeProgram()->count() > 0)
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
                    @if($user->nondegreetrainingSeminarsWorkshops()->count() > 0)
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
                    @if($user->nondegreetrainingCulturalEducationalTravel()->count() > 0)
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
    <div class="text-center">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <canvas id="myChart" class="col-md-9"></canvas>
        <div class="col-md-2">
            <div style="background-color: rgba(255, 99, 132, 1); height: 3%; width: 20%"></div>English Studies
            <div style="background-color: rgba(54, 162, 235, 1); height: 3%; width: 20%"></div>Literatures
            <div style="background-color: rgba(255, 206, 86, 1); height: 3%; width: 20%"></div>Philosophy
            <div style="background-color: rgba(75, 192, 192, 1); height: 3%; width: 20%"></div>Economics
            <div style="background-color: rgba(153, 102, 255, 1); height: 3%; width: 20%"></div>Foreign Language
            <div style="background-color: rgba(212, 108, 218, 1); height: 3%; width: 20%"></div>Political Science
            <div style="background-color: rgba(234, 255, 81, 1); height: 3%; width: 20%"></div>Sociology
            <div style="background-color: rgba(15, 88, 13, 1); height: 3%; width: 20%"></div>History
            <div style="background-color: rgba(0, 37, 224, 1); height: 3%; width: 20%"></div>Comm & Media Studies
            <div style="background-color: rgba(122, 75, 5, 1); height: 3%; width: 20%"></div>Interdisciplinary
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="col-md-3">
            <div class="card ml-5" style="width: 25rem;">
                <div class="card-body">
                    <h3>Male: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $maleCount }}</h3>
                    <h3>Female: &nbsp&nbsp&nbsp{{ $femaleCount }}</h3>
                </div>
            </div>
            <br>
            <div class="card ml-5" style="width: 25rem;">
                <div class="card-body">
                    <h3>Tenured: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{ $tenured }}</h3>
                    <h3>Not Tenured: &nbsp&nbsp&nbsp{{ $notTenured }}</h3>
                </div>
            </div>
        </div>
    </div>
    
 @endsection

 @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
        <script>
        var canvasP = document.getElementById('myChart');
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['English Studies', 'Literatures', 'Philosophy', 'Economics', 'Foreign Language', 'Political Science', 'Sociology', 'History', 'Comm & Media Studies', 'Interdisciplinary'],
                datasets: [{
                    label: 'Active members per Department',
                    data: [ {{$englishStudies}}, {{ $literatures }}, {{ $philosophy }}, {{ $economics }}, {{ $foreignLanguage }}, {{ $politicalScience }}, {{ $sociology }}, {{ $history }}, {{ $commAndMediaStudies }}, {{ $interdisciplinary }} ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(212, 108, 218, 0.2)',
                        'rgba(234, 255, 81, 0.2)',
                        'rgba(15, 88, 13, 0.2)',
                        'rgba(0, 37, 224, 0.2)',
                        'rgba(122, 75, 5, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(212, 108, 218, 1)',
                        'rgba(234, 255, 81, 1)',
                        'rgba(15, 88, 13, 1)',
                        'rgba(0, 37, 224, 1)',
                        'rgba(122, 75, 5, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                    scales: {
                         yAxes: [{
                            ticks: {
                                precision:0,
                                beginAtZero: true
                                    }
                                }]
                            }
            }
            
        });

        // canvasP.onclick = function(e) {
        //     var slice = myChart.getElementAtEvent(e);
        //     if (!slice.length) return; // return if not clicked on slice
        //     var label = slice[0]._model.label;
        //     switch (label) {
        //         // add case for each label/slice
        //         case 'English Studies':
        //             alert('clicked on slice 5');
        //             window.open('http://softeng.test/departments/englishstudies');
        //             break;
               
        //         // add rests ...
        //     }
        // }
        </script>
        <script>
        var ctx = document.getElementById('pieChart');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ['Instructor I', 'Instructor II', 'Instructor III', 'Instructor IV', 'Instructor V  ', 'Asst. Professor I', 'Asst. Professor II', 'Asst. Professor III', 'Asst. Professor IV', 'Asst. Professor V', 'Assoc. Professor I', 'Assoc. Professor II', 'Assoc. Professor III', 'Assoc. Professor IV', 'Assoc. Professor V', 'Professor I', 'Professor II', 'Professor III', 'Professor IV' ,'Professor V'],
                datasets: [{
                    label: 'Ranks',
                    data: [{{ $one }}, {{ $two }}, {{ $three }}, {{ $four }}, {{ $five }}, {{ $six }}, {{ $seven }}, {{ $eight }}, {{ $nine }}, {{ $ten }}, {{ $eleven }}, {{ $twelve }}, {{ $thirteen }}, {{ $fourteen }}, {{ $fifthteen }}, {{ $sixteen }}, {{ $seventeen }}, {{ $eighteen }}, {{ $nineteen }}, {{ $twenthy }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                    scales: {
                         xAxes: [{
                            ticks: {
                                beginAtZero: true ,
                                userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }
                                    }
                            }
                                }]
                            }
                }
                
            
        });
        </script>
 @endsection

 