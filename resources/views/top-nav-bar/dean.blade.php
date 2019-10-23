<div style = "position: sticky; top: 0; z-index: 9999;">
        <ul class="nav nav-tabs navbar-default" style="background-color: #1DA1F2;"> 
            <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('dean.departments') }}">Dashboard<i class="fas fa-home"></i></a></li>
            <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('dean.index') }}">Profile<i class="fas fa-user-alt"></i></a></li>
            <li class="nav-item mt-3 mr-3 col-md-offset-7" style="color: azure">Logged In as <strong>{{ auth()->user()->name }}</strong> a Faculty Admin</li>
            <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('dean.changepassword') }}">Change Password<i class="fas fa-key"></i></a></li>
            <li class="nav-item"><a class="nav-link active" data-bs-hover-animate="wobble" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout<i class="fas fa-power-off"></i></a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>    
       
    </div>