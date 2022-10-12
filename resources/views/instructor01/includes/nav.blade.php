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
        <li><a href="{{ route('instructor-dashboard') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/dashboard.svg')}}" alt=""/></i> Dashboard</a> <a class="totalCount" href="{{ route('instructor-dashboard') }}">Summary</a> </li>
        <li><a href="{{ route('instructor-course') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/courses.svg')}}" alt=""/></i> Courses</a> <a class="totalCount" href="{{ route('instructor-course') }}"> Courses</a> </li>
        <li><a href="{{ route('instructor-review') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/reviews.svg')}}" alt=""/></i> Reviews</a> <a class="totalCount" href="{{ route('instructor-review') }}"> Student Reviews</a> </li>
         <li><a href="{{ route('instructor-assessment') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img class="menuIcon" src="{{asset('assets/images/transaction.svg')}}" alt=""/></i> Assessment</a> <a class="totalCount" href="{{ route('instructor-assessment') }}"> Student Assessment</a> </li>
        <li> <a href="{{ route('instructor-sale') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img src="{{asset('assets/images/sales.svg')}}" alt=""/></i> Sales</a> <a class="totalCount" href="{{ route('instructor-sale') }}"> Courses Sold</a> </li>
        <li> <a href="{{ route('instructor-stripe-connect') }}" class="sidebarMenuItem"> <i class="metismenu-icon"><img src="{{asset('assets/images/sales.svg')}}" alt=""/></i> Connect With Stripe</a> <a class="totalCount" href="{{ route('instructor-stripe-connect') }}">Connect With Stripe</a> </li>
     <?php /*?>   <li> <a href="transactions.php" class="sidebarMenuItem"> <i class="metismenu-icon"><img src="{{asset('assets/images/transaction.svg')}}" alt=""/></i> Transactions</a> <a class="totalCount" href="#"> Transactions</a> </li>
        <li> <a href="reviews.php" class="sidebarMenuItem"> <i class="metismenu-icon"><img src="{{asset('assets/images/reviews.svg')}}" alt=""/></i> Reviews</a> <a class="totalCount" href="#"> Reviews</a> </li><?php */?>
        <li> <a href="{{ route('instructor-logout') }}" class="logOut"><i class="metismenu-icon"><img src="{{asset('assets/images/logout.svg')}}" alt=""/></i> Log Out</a> </li>
      </ul>
    </div>
  </div>
</div>
