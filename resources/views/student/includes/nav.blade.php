<div class="sidemenu-area">
  <div class="sidemenu-header"> <a href="{{ route('student-dashboard') }}" class="navbar-brand d-flex align-items-center"> <img src="{{ asset('assets/images/edruptz.svg') }}" alt="image" style="width:40px"> <span>EDRUPTZ</span> </a>
    <div class="burger-menu d-none d-lg-block"> <span class="top-bar"></span> <span class="middle-bar"></span> <span
                class="bottom-bar"></span> </div>
    <div class="responsive-burger-menu d-block d-lg-none"> <span class="top-bar"></span> <span
                class="middle-bar"></span> <span class="bottom-bar"></span> </div>
  </div>
  <div class="sidemenu-body">
    <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
      <li class="nav-item @if (empty($nav)) mm-active @endif"> <a
                    href="{{ route('student-dashboard') }}" class="nav-link"> <span class="icon"><i
                            class='bx bx-tachometer'></i></span> <span class="menu-title">Dashboard</span> </a> </li>
      <li class="nav-item @if ($nav == 'course') mm-active @endif"> <a
                    href="{{ route('student-course') }}" class="nav-link"> <span class="icon"><i
                            class='bx bxs-component'></i></span> <span class="menu-title">My Courses</span> </a> </li>
      <li class="nav-item @if ($nav == 'courses') mm-active @endif"> <a
                    href="{{ route('courses') }}" class="nav-link"> <span class="icon"><i
                            class='bx bxs-component'></i></span> <span class="menu-title">Explore Courses</span> </a> </li>
      <li class="nav-item"> <a href="{{ route('student-logout') }}" class="nav-link"> <span class="icon"><i class="bx bxs-log-out"></i></span> <span class="menu-title">Logout</span> </a> </li>
    </ul>
  </div>
</div>
