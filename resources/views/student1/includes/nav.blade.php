<div class="app-sidebar sidebar-shadow">
  <div class="app-header__logo">
    <div class="header__pane ml-auto">
      <div>
        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
      </div>
    </div>
  </div>
  <div class="app-header__mobile-menu">
    <div>
      <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
    </div>
  </div>
  <div class="app-header__menu"> <span>
    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"> <span class="btn-icon-wrapper"> <i class="fa fa-ellipsis-v fa-w-6"></i> </span> </button>
    </span> </div>
  <div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
      <ul class="vertical-nav-menu">
        <li><a href="{{ route('student-dashboard') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/dashboard.svg')}}" alt=""/></i> Dashboard</a><a class="totalCount" href="{{ route('student-dashboard') }}">Summery</a> </li>
        <li><a href="{{ route('student-course') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/courses.svg')}}" alt=""/></i> My Courses</a> <a class="totalCount" href="{{ route('student-course') }}">My Courses</a>  </li>
        <li><a href="{{ route('courses') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/courses.svg')}}" alt=""/></i> Explore Courses</a> <a class="totalCount" href="{{ route('courses') }}">Explore Courses</a>  </li>
       <?php /*?> <li> <a href="" class="sidebarMenuItem"> <i class="metismenu-icon"><img src="{{asset('assets/images/sales.svg')}}" alt=""/></i> Invoices</a> </li><?php */?>
        <li> <a  href="{{ route('student-logout') }}" class="logOut"><i class="metismenu-icon"><img src="{{asset('assets/images/logout.svg')}}" alt=""/></i> Log Out</a> </li>
      </ul>
    </div>
  </div>
</div>
