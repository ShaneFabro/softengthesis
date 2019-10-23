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
                        <h3 class="col-md-4">Scholarly Productions</h3>
                    </div>
                    <div class="bg-light">
                        <p class="col-md-offset-1" style="color: black">a. Published articles/researches in reputable journals</p>
                    </div>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.pub.refer') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-2">i. Refereed</p>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Nature of Publication</th>
                                <th>Date of Publication</th>
                                <th>Role / Comments</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach(auth()->user()->researchScholarPubRefers as $researchScholarPubRefers)
                                <tr>
                                    <td>{{ $researchScholarPubRefers->nature_of_publication }}</td>
                                    <td>{{ \Carbon\Carbon::parse($researchScholarPubRefers->date_publication)->format('M Y') }}</td>
                                    <td>{{ $researchScholarPubRefers->role_comments }}</td>
                                    <td><a href="{{ route('edit.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.research.scholar.pub.refer', $researchScholarPubRefers->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.pub.nonrefer') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-2">ii. Non-Refereed</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarPubNonRefers as $researchScholarPubNonRefers)
                            <tr>
                                <td>{{ $researchScholarPubNonRefers->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarPubNonRefers->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarPubNonRefers->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.pub.nonrefer', $researchScholarPubNonRefers->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.fullbook') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">b. Full-lenghts Books</p>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Nature of Publication</th>
                                <th>Date of Publication</th>
                                <th>Role / Comments</th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach(auth()->user()->researchScholarFullBooks as $researchScholarFullBooks)
                                <tr>
                                    <td>{{ $researchScholarFullBooks->nature_of_publication }}</td>
                                    <td>{{ \Carbon\Carbon::parse($researchScholarFullBooks->date_publication)->format('M Y') }}</td>
                                    <td>{{ $researchScholarFullBooks->role_comments }}</td>
                                    <td><a href="{{ route('edit.research.scholar.fullbook', $researchScholarFullBooks->id) }}" class="btn btn-info">Edit</a></td>
                                    <form action="{{ route('delete.research.scholar.fullbook', $researchScholarFullBooks->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.prenonscribed.pubbook') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">c. Prescribed/Non-Prescribed published textbooks</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarPreNonScribePubBooks as $researchScholarPreNonScribePubBooks)
                            <tr>
                                <td>{{ $researchScholarPreNonScribePubBooks->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarPreNonScribePubBooks->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarPreNonScribePubBooks->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.prenonscribed.pubbook', $researchScholarPreNonScribePubBooks->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.profjournal') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">d. Professional Journal</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarProfJournals as $researchScholarProfJournals)
                            <tr>
                                <td>{{ $researchScholarProfJournals->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarProfJournals->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarProfJournals->role_comments }}</td>
                                <td><a href="{{ route('edit.nresearch.scholar.profjournal', $researchScholarProfJournals->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.profjournal', $researchScholarProfJournals->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.locjournal') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">e. Local Journal</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarLocJournals as $researchScholarLocJournals)
                            <tr>
                                <td>{{ $researchScholarLocJournals->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarLocJournals->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarLocJournals->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.locjournal', $researchScholarLocJournals->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.locjournal', $researchScholarLocJournals->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.delpubpaper') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">e. Delivered & Published Papers/lectures/Speeches</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarDelPubPaper as $researchScholarDelPubPaper)
                            <tr>
                                <td>{{ $researchScholarDelPubPaper->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarDelPubPaper->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarDelPubPaper->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.delpubpaper', $researchScholarDelPubPaper->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.commcompresearch') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">e. Commissioned and Completed Researches</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarCommCompResearches as $researchScholarCommCompResearches)
                            <tr>
                                <td>{{ $researchScholarCommCompResearches->nature_of_publication }}</td>
                                <td>{{ \Carbon\Carbon::parse($researchScholarCommCompResearches->date_publication)->format('M Y') }}</td>
                                <td>{{ $researchScholarCommCompResearches->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.commcompresearch', $researchScholarCommCompResearches->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-light">
                        <a href="{{ route('add.research.scholar.researchposter') }}" class="btn btn-success float-right">Add</a>
                        <p class="col-md-offset-1" style="color: black">e. Research Posters</p>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nature of Publication</th>
                            <th>Date of Publication</th>
                            <th>Role / Comments</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->researchScholarResearchPosters as $researchScholarResearchPosters)
                            <tr>
                                <td>{{ $researchScholarResearchPosters->nature_of_publication }}</td>
                                <td>{{ $researchScholarResearchPosters->date_publication ? \Carbon\Carbon::parse($researchScholarResearchPosters->date_publication)->format('M Y') : '' }}</td>
                                <td>{{ $researchScholarResearchPosters->role_comments }}</td>
                                <td><a href="{{ route('edit.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" class="btn btn-info">Edit</a></td>
                                <form action="{{ route('delete.research.scholar.researchposter', $researchScholarResearchPosters->id) }}" method="POST">
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
            <h3 class="col-md-4">Creative Works</h3>
        </div>
        <div class="bg-light">
            <a href="{{ route('add.research.creative.distperfart') }}" class="btn btn-success float-right">Add</a>
            <p class="col-md-offset-1" style="color: black">a. Distinguished performance in any of the performing arts</p>
        </div>
        <table class="table">
                <thead>
                    <th>Nature of Publication</th>
                    <th>Date of Publication</th>
                    <th>Role / Comments</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach(auth()->user()->researchCreativeDistPerfArts as $researchCreativeDistPerfArts)
                    <tr>
                        <td>{{ $researchCreativeDistPerfArts->nature_of_publication }}</td>
                        <td>{{ \Carbon\Carbon::parse($researchCreativeDistPerfArts->date_publication)->format('M Y') }}</td>
                        <td>{{ $researchCreativeDistPerfArts->role_comments }}</td>
                        <td><a href="{{ route('edit.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" class="btn btn-info">Edit</a></td>
                        <form action="{{ route('delete.research.creative.distperfart', $researchCreativeDistPerfArts->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
        </table>
<div class="bg-light">
    <a href="{{ route('add.research.creative.origmusicwork') }}" class="btn btn-success float-right">Add</a>
    <p class="col-md-offset-1" style="color: black">b. Original Musical Work</p>
</div>
<table class="table">
    <thead>
        <th>Nature of Publication</th>
        <th>Date of Publication</th>
        <th>Role / Comments</th>    
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach(auth()->user()->researchCreativeOrigMusicalWorks as $researchCreativeOrigMusicalWorks)
        <tr>
            <td>{{ $researchCreativeOrigMusicalWorks->nature_of_publication }}</td>
            <td>{{ \Carbon\Carbon::parse($researchCreativeOrigMusicalWorks->date_publication)->format('M Y') }}</td>
            <td>{{ $researchCreativeOrigMusicalWorks->role_comments }}</td>
            <td><a href="{{ route('edit.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" class="btn btn-info">Edit</a></td>
            <form action="{{ route('delete.research.creative.origmusicwork', $researchCreativeOrigMusicalWorks->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger">Delete</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bg-light">
    <a href="{{ route('add.research.creative.origdesign') }}" class="btn btn-success float-right">Add</a>
    <p class="col-md-offset-1" style="color: black">c. Original Design</p>
</div>
<table class="table">
    <thead>
        <th>Nature of Publication</th>
        <th>Date of Publication</th>
        <th>Role / Comments</th>    
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach(auth()->user()->researchCreateOrigDesigns as $researchCreateOrigDesigns)
        <tr>
            <td>{{ $researchCreateOrigDesigns->nature_of_publication }}</td>
            <td>{{ \Carbon\Carbon::parse($researchCreateOrigDesigns->date_publication)->format('M Y') }}</td>
            <td>{{ $researchCreateOrigDesigns->role_comments }}</td>
            <td><a href="{{ route('edit.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" class="btn btn-info">Edit</a></td>
            <form action="{{ route('delete.research.creative.origdesign', $researchCreateOrigDesigns->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger">Delete</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bg-light">
    <a href="{{ route('add.research.creative.litwork') }}" class="btn btn-success float-right">Add</a>
    <p class="col-md-offset-1" style="color: black">d. Published / Acknowledge Literary Works</p>
</div>
<table class="table">
    <thead>
        <th>Nature of Publication</th>
        <th>Date of Publication</th>
        <th>Role / Comments</th>    
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach(auth()->user()->researchCreativeLitWorks as $researchCreativeLitWorks)
        <tr>
            <td>{{ $researchCreativeLitWorks->nature_of_publication }}</td>
            <td>{{ \Carbon\Carbon::parse($researchCreativeLitWorks->date_publication)->format('M Y') }}</td>
            <td>{{ $researchCreativeLitWorks->role_comments }}</td>
            <td><a href="{{ route('edit.research.creative.litwork', $researchCreativeLitWorks->id) }}" class="btn btn-info">Edit</a></td>
            <form action="{{ route('delete.research.creative.litwork', $researchCreativeLitWorks->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger">Delete</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bg-light">
    <a href="{{ route('add.research.creative.exartwork') }}" class="btn btn-success float-right">Add</a>
    <p class="col-md-offset-1" style="color: black">e. Exhibited Art Works</p>
</div>
<table class="table">
    <thead>
        <th>Nature of Publication</th>
        <th>Date of Publication</th>
        <th>Role / Comments</th>    
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach(auth()->user()->researchCreativeExArtWorks as $researchCreativeExArtWorks)
        <tr>
            <td>{{ $researchCreativeExArtWorks->nature_of_publication }}</td>
            <td>{{ \Carbon\Carbon::parse($researchCreativeExArtWorks->date_publication)->format('M Y') }}</td>
            <td>{{ $researchCreativeExArtWorks->role_comments }}</td>
            <td><a href="{{ route('edit.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" class="btn btn-info">Edit</a></td>
            <form action="{{ route('delete.research.creative.exartwork', $researchCreativeExArtWorks->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <td><button type="submit" class="btn btn-danger">Delete</button></td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="bg-light">
    <a href="{{ route('add.research.creative.gencirculation') }}" class="btn btn-success float-right">Add</a>
    <p class="col-md-offset-1" style="color: black">e. Critiques, Position papers published in newspapers of general Circulation</p>
</div>
<table class="table">
    <thead>
        <th>Nature of Publication</th>
        <th>Date of Publication</th>
        <th>Role / Comments</th>    
        <th></th>
        <th></th>
    </thead>
    <tbody>
        @foreach(auth()->user()->researchCreativeGenCirculations as $researchCreativeGenCirculations)
        <tr>
            <td>{{ $researchCreativeGenCirculations->nature_of_publication }}</td>
            <td>{{ \Carbon\Carbon::parse($researchCreativeGenCirculations->date_publication)->format('M Y') }}</td>
            <td>{{ $researchCreativeGenCirculations->role_comments }}</td>
            <td><a href="{{ route('edit.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" class="btn btn-info">Edit</a></td>
            <form action="{{ route('delete.research.creative.gencirculation', $researchCreativeGenCirculations->id) }}" method="POST">
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
<div class="container pt-5">
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-default">
            <div class="card-header bg-primary">
                <h3 class="col-md-4">Educational Aids and Technology </h3>
            </div>
            <div class="bg-light">
                <p class="col-md-offset-1" style="color: black">a. Material Production</p>
            </div>
            <div class="bg-light">
                <a href="{{ route('add.research.creative.aidtech.matprod.coursemodule') }}" class="btn btn-success float-right">Add</a>
                <p class="col-md-offset-2">i. Course Modules</p>
            </div>
            <table class="table">
                    <thead>
                        <th>Nature of Publication</th>
                        <th>Date of Publication</th>
                        <th>Role / Comments</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->researchCreativeAidTechMatProdCourseModules as $researchCreativeAidTechMatProdCourseModules)
                        <tr>
                            <td>{{ $researchCreativeAidTechMatProdCourseModules->nature_of_publication }}</td>
                            <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdCourseModules->date_publication)->format('M Y') }}</td>
                            <td>{{ $researchCreativeAidTechMatProdCourseModules->role_comments }}</td>
                            <td><a href="{{ route('edit.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" class="btn btn-info">Edit</a></td>
                            <form action="{{ route('delete.research.creative.aidtech.matprod.coursemodule', $researchCreativeAidTechMatProdCourseModules->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                  
                    
            </table>
            <div class="bg-light">

                <a href="{{ route('add.research.creative.aidtech.matprod.onlinecourse') }}" class="btn btn-success float-right">Add</a>
                <p class="col-md-offset-2">ii. Online Courses</p>
                
            </div>
            <table class="table">
                    <thead>
                        <th>Nature of Publication</th>
                        <th>Date of Publication</th>
                        <th>Role / Comments</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->researchCreativeAidTechMatProdOnlineCourses as $researchCreativeAidTechMatProdOnlineCourses)
                        <tr>
                            <td>{{ $researchCreativeAidTechMatProdOnlineCourses->nature_of_publication }}</td>
                            <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdOnlineCourses->date_publication)->format('M Y') }}</td>
                            <td>{{ $researchCreativeAidTechMatProdOnlineCourses->role_comments }}</td>
                            <td><a href="{{ route('edit.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" class="btn btn-info">Edit</a></td>
                            <form action="{{ route('delete.research.creative.aidtech.matprod.onlinecourse', $researchCreativeAidTechMatProdOnlineCourses->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
               
                    
            </table>
            <div class="bg-light">
                <a href="{{ route('add.research.creative.aidtech.matprod.manual') }}" class="btn btn-success float-right">Add</a>
                <p class="col-md-offset-2">iii. Laboratory manuals, Course manuals or Workbook in actual use by the department or college</p>
            </div>
            <table class="table">
                    <thead>
                        <th>Nature of Publication</th>
                        <th>Date of Publication</th>
                        <th>Role / Comments</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach(auth()->user()->researchCreativeAidTechMatProdManuals as $researchCreativeAidTechMatProdManuals)
                        <tr>
                            <td>{{ $researchCreativeAidTechMatProdManuals->nature_of_publication }}</td>
                            <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechMatProdManuals->date_publication)->format('M Y') }}</td>
                            <td>{{ $researchCreativeAidTechMatProdManuals->role_comments }}</td>
                            <td><a href="{{ route('edit.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" class="btn btn-info">Edit</a></td>
                            <form action="{{ route('delete.research.creative.aidtech.matprod.manual', $researchCreativeAidTechMatProdManuals->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                   
                    
            </table>
            <div class="bg-light">
                <a href="{{ route('add.research.creative.aidtech.techaid') }}" class="btn btn-success float-right">Add</a>
                <p class="col-md-offset-1" style="color: black">b. Teaching aids produced for use in the department and /or Faculty or College</p>
            </div>
            <table class="table">
                <thead>
                    <th>Nature of Publication</th>
                    <th>Date of Publication</th>
                    <th>Role / Comments</th>    
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach(auth()->user()->researchCreativeAidTechTechAids as $researchCreativeAidTechTechAids)
                    <tr>
                        <td>{{ $researchCreativeAidTechTechAids->nature_of_publication }}</td>
                        <td>{{ \Carbon\Carbon::parse($researchCreativeAidTechTechAids->date_publication)->format('M Y') }}</td>
                        <td>{{ $researchCreativeAidTechTechAids->role_comments }}</td>
                        <td><a href="{{ route('edit.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" class="btn btn-info">Edit</a></td>
                        <form action="{{ route('delete.research.creative.aidtech.techaid', $researchCreativeAidTechTechAids->id) }}" method="POST">
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