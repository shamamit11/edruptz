<div class="sidemenu-area">
    <div class="sidemenu-header"> <a href="{{ route('admin-dashboard')}}"
            class="navbar-brand d-flex align-items-center"> <img src="{{ asset('assets/images/edruptz.svg') }}"
                alt="image" style="width:40px"> <span>EDRUPTZ</span> </a>
        <div class="burger-menu d-none d-lg-block"> <span class="top-bar"></span> <span class="middle-bar"></span> <span
                class="bottom-bar"></span> </div>
        <div class="responsive-burger-menu d-block d-lg-none"> <span class="top-bar"></span> <span
                class="middle-bar"></span> <span class="bottom-bar"></span> </div>
    </div>
    <div class="sidemenu-body">
        <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
            <li class="nav-item @if(empty($nav)) mm-active @endif"> <a href="{{ route('admin-dashboard')}}"
                    class="nav-link"> <span class="icon"><i class='bx bx-tachometer'></i></span> <span
                        class="menu-title">Dashboard</span> </a> </li>
            <li class="nav-item @if($nav == 'search') mm-active @endif"> <a href="{{ route('admin-search')}}"
                    class="nav-link"> <span class="icon"><i class='bx bx-search'></i></span> <span
                        class="menu-title">Search keyword</span> </a> </li>
            
            <li class="nav-item @if($nav == 'instructor') mm-active @endif"> <a href="{{ route('admin-instructor')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-user'></i></span> <span
                        class="menu-title">Instructors</span> </a> </li>
            <li class="nav-item @if($nav == 'student') mm-active @endif"> <a href="{{ route('admin-student')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-user'></i></span> <span
                        class="menu-title">Student</span> </a> </li>
            <li class="nav-item @if($nav == 'commission') mm-active @endif"> <a href="{{ route('admin-commission')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Commission</span> </a> </li>
            <li class="nav-item @if($nav == 'category') mm-active @endif"> <a href="{{ route('admin-category')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Category</span> </a> </li>
            <li class="nav-item @if($nav == 'blog') mm-active @endif"> <a href="{{ route('admin-blog')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Blog</span> </a> </li>
                        <li class="nav-item @if($nav == 'skill') mm-active @endif"> <a href="{{ route('admin-skill')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Skill</span> </a> </li>
            <li class="nav-item @if($nav == 'email') mm-active @endif"> <a href="{{ route('admin-email')}}"
                    class="nav-link"> <span class="icon"><i class='bx bx-envelope'></i></span> <span
                        class="menu-title">Newsletter Subscriptions</span> </a> </li>
            <li class="nav-item @if($nav == 'faq') mm-active @endif"> <a href="{{ route('admin-faq')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Faqs</span> </a> </li>
            <li class="nav-item @if($nav == 'page') mm-active @endif"> <a href="{{ route('admin-page')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-news'></i></span> <span
                        class="menu-title">Pages</span> </a> </li>
            <li class="nav-item @if($nav == 'review') mm-active @endif"> <a href="{{ route('admin-review')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-pencil'></i></span> <span
                        class="menu-title">Edruptz Reviews</span> </a> </li>
            <li class="nav-item @if($nav == 'banner') mm-active @endif"> <a href="{{ route('admin-banner')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-image-alt'></i></span> <span
                        class="menu-title">Banner Images</span> </a> </li>
            <li class="nav-item @if($nav == 'partner') mm-active @endif"> <a href="{{ route('admin-partner')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-image-alt'></i></span> <span
                        class="menu-title">Partner's Logos</span> </a> </li>
            <li class="nav-item @if($nav == 'setting') mm-active @endif"> <a href="{{ route('admin-setting')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-brightness'></i></span> <span
                        class="menu-title">General Settings</span> </a> </li>
            <li class="nav-item @if($nav == 'seo') mm-active @endif"> <a href="{{ route('admin-seo')}}"
                    class="nav-link"> <span class="icon"><i class='bx bx-atom'></i></span> <span
                        class="menu-title">SEO</span> </a> </li>
            <li class="nav-item @if($nav == 'socialicon') mm-active @endif"> <a href="{{ route('admin-socialicon')}}"
                    class="nav-link"> <span class="icon"><i class='bx bxs-share-alt'></i></span> <span
                        class="menu-title">Social Links</span> </a> </li>
            <li class="nav-item"> <a href="{{ route('admin-logout')}}" class="nav-link"> <span class="icon"><i
                            class='bx bxs-log-out'></i></span> <span class="menu-title">Logout</span> </a> </li>
        </ul>
    </div>
</div>