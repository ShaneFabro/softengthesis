@extends('layouts.inside')

@section('top-nav-bar')

@include('top-nav-bar.member')

@endsection
    
@section('side-nav-bar')

@include('side-nav-bar.member')

@endsection

@section('content')
<div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header bg-primary">
                        <h3 class="col-md-4">Community Service</h3>
                    </div>
                    <div class="bg-light">
                        <p class="col-md-offset-1" style="color: black">a. Community Development</p>
                    </div>
                    <div class="bg-light">
                        <a href="{{ route('add.commextservicecommservice.devuniv') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-2">i. University-Initiated</p>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            
                            <tbody>
                                @foreach(auth()->user()->commExtServiceCommServiceDevUnivInitiates as $commExtServiceCommServiceDevUnivInitiates)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                    <td>{{ $commExtServiceCommServiceDevUnivInitiates->title}}</td>
                                    <td>{{ $commExtServiceCommServiceDevUnivInitiates->role }}</td>
                                    <td><a href="{{ route('edit.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.commextservicecommservice.devuniv', $commExtServiceCommServiceDevUnivInitiates->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            
                    </table>
                    <div class="bg-light">
                        
                            <a href="{{ route('add.commextservicecommservice.devext') }}" class="btn btn-success float-right">Add</a>
                        
                        <p class="col-md-offset-2">ii. Externally-Initiated</p>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            
                            <tbody>
                                @foreach(auth()->user()->commExtServiceCommServiceDevExtInitiates as $commExtServiceCommServiceDevExtInitiates)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceDevExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceDevExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                    <td>{{ $commExtServiceCommServiceDevExtInitiates->title}}</td>
                                    <td>{{ $commExtServiceCommServiceDevExtInitiates->role }}</td>
                                    <td><a href="{{ route('edit.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.commextservicecommservice.devext', $commExtServiceCommServiceDevExtInitiates->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                           
                    </table>
                    <div class="bg-light">
                        <p class="col-md-offset-1" style="color: black">b. Humanitarian/Relief Mission</p>
                    </div>
                    <div class="bg-light">
                        
                            <a href="{{ route('add.commextservicecommservice.humanuniv') }}" class="btn btn-success float-right">Add</a>
                        
                        <p class="col-md-offset-2">i. University-Initiated</p>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            
                            <tbody>
                                @foreach(auth()->user()->commExtServiceCommServiceHumanUnivInitiates as $commExtServiceCommServiceHumanUnivInitiates)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                    <td>{{ $commExtServiceCommServiceHumanUnivInitiates->title}}</td>
                                    <td>{{ $commExtServiceCommServiceHumanUnivInitiates->role }}</td>
                                    <td><a href="{{ route('edit.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.commextservicecommservice.humanuniv', $commExtServiceCommServiceHumanUnivInitiates->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                            
                    </table>
                    <div class="bg-light">
                        
                            <a href="{{ route('add.commextservicecommservice.humanext') }}" class="btn btn-success float-right">Add</a>
                        
                        <p class="col-md-offset-2">ii. Externally-Initiated</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Inclusive Date</th>
                            <th>Title/Nature of Activities / Services</th>
                            <th>Role / Participation</th>
                            <th></th>
                            <th></th>
                        </thead>
                        
                        <tbody>
                            @foreach(auth()->user()->commExtServiceCommServiceHumanExtInitiates as $commExtServiceCommServiceHumanExtInitiates)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceHumanExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                <td>{{ $commExtServiceCommServiceHumanExtInitiates->title}}</td>
                                <td>{{ $commExtServiceCommServiceHumanExtInitiates->role }}</td>
                                <td><a href="{{ route('edit.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.commextservicecommservice.humanext', $commExtServiceCommServiceHumanExtInitiates->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                        
                        <div class="bg-light">
                            <p class="col-md-offset-1" style="color: black">c. Involvement in Advocacy Activities</p>
                        </div>
                        <div class="bg-light">
                            
                                <a href="{{ route('add.commextservicecommservice.advouniv') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">i. University-Initiated</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            
                            <tbody>
                                @foreach(auth()->user()->commExtServiceCommServiceAdvoUnivInitiates as $commExtServiceCommServiceAdvoUnivInitiates)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoUnivInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                    <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->title}}</td>
                                    <td>{{ $commExtServiceCommServiceAdvoUnivInitiates->role }}</td>
                                    <td><a href="{{ route('edit.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.commextservicecommservice.advouniv', $commExtServiceCommServiceAdvoUnivInitiates->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        <div class="bg-light">
                            
                                <a href="{{ route('add.commextservicecommservice.advoext') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">ii. Externally-Initiated</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            
                            <tbody>
                                @foreach(auth()->user()->commExtServiceCommServiceAdvoExtInitiates as $commExtServiceCommServiceAdvoExtInitiates)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtServiceCommServiceAdvoExtInitiates->inclusive_date_to)->format('M d Y') }}</td>
                                    <td>{{ $commExtServiceCommServiceAdvoExtInitiates->title}}</td>
                                    <td>{{ $commExtServiceCommServiceAdvoExtInitiates->role }}</td>
                                    <td><a href="{{ route('edit.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.commextservicecommservice.advoext', $commExtServiceCommServiceAdvoExtInitiates->id) }}" method="POST">
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
                            
                            
                            
                            <h3 class="col-md-4">Extension Service</h3>
                        </div>
                        <div class="bg-light">
                            <a href="{{ route('add.commextserviceextservice.seminar') }}" class="btn btn-success float-right">Add</a>
                            <p class="col-md-offset-1" style="color: black">a. Seminars/Workshops/Conferences/Convention</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Date</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceSeminars as $commExtserviceExtserviceSeminars)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_from)->format('M d Y') }} - {{ \Carbon\Carbon::parse($commExtserviceExtserviceSeminars->inclusive_date_to)->format('M d Y') }}</td>
                                        <td>{{ $commExtserviceExtserviceSeminars->title}}</td>
                                        <td>{{ $commExtserviceExtserviceSeminars->role }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.seminar', $commExtserviceExtserviceSeminars->id) }}" method="POST">
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
                            <p class="col-md-offset-1" style="color: black">b. Professional standing, Recognition and Achievements</p>
                        </div>
                        <div class="bg-light">
                            
                            <a href="{{ route('add.commextserviceextservice.profstandoff.international') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">i. International Officership / Membership in Professional Organizations</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceProfStandOffInternationals as $commExtserviceExtserviceProfStandOffInternationals)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffInternationals->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->title}}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffInternationals->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.profstandoff.international', $commExtserviceExtserviceProfStandOffInternationals->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.profstandoff.national') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">ii. National Officership / Membership in Professional Organizations</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceProfStandOffNationals as $commExtserviceExtserviceProfStandOffNationals)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffNationals->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->title}}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffNationals->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.profstandoff.national', $commExtserviceExtserviceProfStandOffNationals->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.profstandoffacad.international') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">iii. International Officership / Membership in Academic Organizations</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceProfStandOffAcadInternationals as $commExtserviceExtserviceProfStandOffAcadInternationals)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadInternationals->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->title}}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadInternationals->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.profstandoffacad.international', $commExtserviceExtserviceProfStandOffAcadInternationals->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.profstandoffacad.national') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">iv. National Officership / Membership in Academic Organizations</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceProfStandOffAcadNationals as $commExtserviceExtserviceProfStandOffAcadNationals)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_from }} - {{ $commExtserviceExtserviceProfStandOffAcadNationals->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->title}}</td>
                                        <td>{{ $commExtserviceExtserviceProfStandOffAcadNationals->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.profstandoffacad.national', $commExtserviceExtserviceProfStandOffAcadNationals->id) }}" method="POST">
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
                            <p class="col-md-offset-1" style="color: black">c. Managerial Work</p>
                        </div>
                        <div class="bg-light">
                            
                            <a href="{{ route('add.commextserviceextservice.manwork.government') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">i. Government</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                               
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceManWorkGovernments as $commExtserviceExtserviceManWorkGovernments)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkGovernments->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkGovernments->title}}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkGovernments->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.manwork.government', $commExtserviceExtserviceManWorkGovernments->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.manwork.private') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-2">ii. Private</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceManWorkPrivates as $commExtserviceExtserviceManWorkPrivates)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkPrivates->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkPrivates->title}}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkPrivates->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.manwork.private', $commExtserviceExtserviceManWorkPrivates->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.manwork.senior') }}" class="btn btn-success float-right">Add</a>
                           
                            <p class="col-md-offset-2">iii. Senior Partner in a nationally recognized professional partnership</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceManWorkSeniors as $commExtserviceExtserviceManWorkSeniors)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_from }} - {{ $commExtserviceExtserviceManWorkSeniors->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkSeniors->title}}</td>
                                        <td>{{ $commExtserviceExtserviceManWorkSeniors->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.manwork.senior', $commExtserviceExtserviceManWorkSeniors->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.consultwork') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-1" style="color: black">d. Consultancy Work</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceConsultWorks as $commExtserviceExtserviceConsultWorks)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceConsultWorks->inclusive_years_from }} - {{ $commExtserviceExtserviceConsultWorks->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceConsultWorks->title}}</td>
                                        <td>{{ $commExtserviceExtserviceConsultWorks->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.consultwork', $commExtserviceExtserviceConsultWorks->id) }}" method="POST">
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
                            
                            <a href="{{ route('add.commextserviceextservice.guestappearance') }}" class="btn btn-success float-right">Add</a>
                            
                            <p class="col-md-offset-1" style="color: black">e. Guest appearance or Feature in media on a topic related to expertise</p>
                        </div>
                        <table class="table">
                            <thead>
                                <th>Inclusive Years</th>
                                <th>Title/Nature of Activities / Services</th>
                                <th>Role / Participation</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody> 
                                
                                <tbody>
                                    @foreach(auth()->user()->commExtserviceExtserviceGuestAppearances as $commExtserviceExtserviceGuestAppearances)
                                    <tr>
                                        <td>{{ $commExtserviceExtserviceGuestAppearances->inclusive_years_from }} - {{ $commExtserviceExtserviceGuestAppearances->inclusive_years_to }}</td>
                                        <td>{{ $commExtserviceExtserviceGuestAppearances->title}}</td>
                                        <td>{{ $commExtserviceExtserviceGuestAppearances->position }}</td>
                                        <td><a href="{{ route('edit.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.commextserviceextservice.guestappearance', $commExtserviceExtserviceGuestAppearances->id) }}" method="POST">
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