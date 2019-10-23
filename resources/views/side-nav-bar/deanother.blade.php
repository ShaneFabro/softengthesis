<div id="sidebar-wrapper" style="background-color: #1DA1F2">
        <ul class="sidebar-nav mt-5">
            @if(auth()->user()->personalParticular()->count() == 0)
            <li> <a href="{{ route('dean.create') }}" style="color: white" class="nav-link">Personal Particulars</a></li>
            @else
            <li> <a href="{{ route('dean.allfaculty') }}" style="color: white" class="nav-link">All Members</a></li>
            <li> <a href="{{ route('dean.englishstudies') }}" style="color: white" class="nav-link">English Studies</a></li>
            <li> <a href="{{ route('dean.literatures') }}" style="color: white" class="nav-link">Literatures</a></li>
            <li> <a href="{{ route('dean.philosophy') }}" style="color: white" class="nav-link">Philosophy</a></li>
            <li> <a href="{{ route('dean.economics') }}" style="color: white" class="nav-link">Economics</a></li>
            <li> <a href="{{ route('dean.foreignlanguage') }}" style="color: white" class="nav-link">Foreign Language</a></li>
            <li><a href="{{ route('dean.politicalscience') }}" style="color: white" class="nav-link">Political Science</a></li>
            <li> <a href="{{ route('dean.sociology') }}" style="color: white" class="nav-link">Sociology</a></li>
            <li> <a href="{{ route('dean.history') }}" style="color: white" class="nav-link">History</a></li>
            <li> <a href="{{ route('dean.commandmediastudies') }}" style="color: white" class="nav-link">Communication & Media Studies</a></li>
            <li> <a href="{{ route('dean.interdisciplinary') }}" style="color: white" class="nav-link">Interdisciplinary</a></li>
            @endif
            
        </ul>
     </div>