<div id="sidebar-wrapper" style="background-color: #1DA1F2">
        <ul class="sidebar-nav mt-5">
            @if(auth()->user()->personalParticular()->count() == 0)
                <li> <a href="{{ route('member.create') }}" style="color: white" class="nav-link">Personal Particulars</a></li>
            @else
            <li> <a href="{{ route('member.create') }}" style="color: white" class="nav-link">Personal Particulars</a></li>
            <li> <a href="{{ route('beforeedit.academic') }}" style="color: white" class="nav-link">Academic Degrees</a></li>
            <li> <a href="{{ route('beforeedit.academic.present') }}" style="color: white" class="nav-link">Present Academic Status</a></li>
            <li> <a href="{{ route('beforeedit.employmenthistory') }}" style="color: white" class="nav-link">Employment History</a></li>
            <li> <a href="{{ route('beforeedit.nondegreetraining') }}" style="color: white" class="nav-link">Non-Degree Training</a></li>
            <li><a href="{{ route('beforeedit.researchcreativeworks') }}" style="color: white" class="nav-link">Research & Creative Works</a></li>
            <li> <a href="{{ route('beforeedit.communityextensionservice') }}" style="color: white" class="nav-link">Community Extension Service</a></li>
            <li> <a href="{{ route('beforeedit.honorsreceived') }}" style="color: white" class="nav-link">Scholarships, Honors and Awards Received</a></li>
            <li> <a href="{{ route('beforeedit.useoftechnology') }}" style="color: white" class="nav-link">Use of Information Technology in Instructional Delivery</a></li>
            @endif
            
        </ul>
    </div>
