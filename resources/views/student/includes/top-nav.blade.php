<nav class="navbar top-navbar navbar-expand">
  <div class="collapse navbar-collapse" id="navbarSupportContent">
    <div class="responsive-burger-menu d-block d-lg-none"> <span class="top-bar"></span> <span class="middle-bar"></span> <span class="bottom-bar"></span> </div>
    <div style="width:100%">
      <ul class="navbar-nav right-nav align-items-center float-end">
        <li class="nav-item dropdown profile-nav-item">
          <button href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="menu-profile"> 
            <span class="name">Hi! {{ $user->name }}</span>
            @if($user->image)
            <img src="{{asset('/storage/uploads/student/'.$user->image)}}" class="rounded-circle">
            @else
            <img src="{{asset('/assets/images/profile.svg')}}" class="rounded-circle" /> @endif
          </div>
          </button>
          <div class="dropdown-menu">
            <div class="dropdown-body">
              <ul class="profile-nav p-0 pt-3">
                <li class="nav-item"> <a href="{{ route('student-account-setting') }}" class="nav-link"> <i class='bx bx-cog'></i> <span>Account Settings</span> </a> </li>
              </ul>
            </div>
            <div class="dropdown-footer">
              <ul class="profile-nav">
                <li class="nav-item"> <a href="{{ route('student-logout') }}" class="nav-link"> <i class='bx bx-log-out'></i> <span>Logout</span> </a> </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
