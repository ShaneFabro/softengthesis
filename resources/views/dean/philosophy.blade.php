@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.dean')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.deanother')

@endsection
 
 @section('content')
    <div class="container text-center">
        <h1>Philosophy</h1>
    </div>
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
    <hr>
    <div class="row">
        <div class="container col-md-4">
            <h3 class="text-center">Faculty Head</h3>
            <div class="row justify-content-center">
            <table class="table mt-5">
                <thead class="thead-dark">
                    <th scope="col" class="text-center">Name</th>
                </thead>
                <tbody>
                    @foreach($head as $heads)
                    <tr>
                        <td class="text-center"><h4><a href="{{ route('dean.show', $heads->id) }}">{{ $heads->name }}</a></h4></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="container col-md-4">
            <h3 class="text-center">Faculty Members</h3>
            <div class="row justify-content-center">
            <table class="table mt-5">
                <thead class="thead-dark">
                    <th scope="col" class="text-center">Name</th>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td class="text-center"><h4><a href="{{ route('dean.show', $member->id) }}">{{ $member->name }}</a></h4></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
 @endsection
 @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
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