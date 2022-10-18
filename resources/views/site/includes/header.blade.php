@php
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Socialicon;
$socialicon = Socialicon::first();
$setting = Setting::first();
@endphp
<div class="transparent_header">
    <header class="header justified
 fixed transparent light_text">
        <section class="header-main scroll_blur scroll_opacity">
            <div class="content-wrap content-row">
                <div class="brand">
                    <div class="blog-logo"> <a href="{{ route('/') }}" title="home" rel="home"> <img
                                class="logo-wrap" src="{{ asset('assets/images/edruptz.svg') }}" alt="EDRUPTZ" /> </a>
                    </div>
                    <div class="blog-title"> <a href="{{ route('/') }}" title="home" rel="home"> <span
                                class="web_title"><span class="title_reveal">EDRUPTZ</span></span> </a></div>
                </div>
                <nav id="menu" role="navigation" class="desktop-menu">
                    <div class="menu-main-menu-personal-container">
                        <ul id="menu-main-menu-personal" class="menu">
                            <li class="menu-item "><a href="{{ route('courses') }}">COURSES</a></li>
                            <li class="menu-item "><a href="{{ route('about-edruptz') }}">ABOUT</a></li>
                            <li class="menu-item "><a href="{{ route('blog') }}">BLOGS</a></li>
                            <li class="menu-item "><a href="{{ route('contact') }}">CONTACT</a></li>
                            <li class="menu-item "><a href="{{ route('cart') }}">CART</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="td connect"> <a href="{{ $socialicon->facebook }}" target="_blank"> <i
                            class="fa fa-facebook" aria-hidden="true"></i></a> <a href="{{ $socialicon->instagram }}"
                        target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i></a> <a
                        href="{{ $socialicon->twitter }}" target="_blank"> <i class="fa fa-twitter"
                            aria-hidden="true"></i></a> </div>
            </div>
        </section>
    </header>
    <section class="header-top  fixed light_text">
        <nav id="menu no-scroll" role="navigation" class="mobile-menu">
            <table>
                <tr>
                    <td>
                        <div class="menu-main-menu-personal-container">
                            <ul id="menu-main-menu-personal-1" class="menu">
                                <li class="menu-item "><a href="{{ route('courses') }}">COURSES</a></li>
                                <li class="menu-item "><a href="{{ route('about-edruptz') }}">ABOUT</a></li>
                                <li class="menu-item "><a href="{{ route('blog') }}">BLOGS</a></li>
                                <li class="menu-item "><a href="{{ route('contact') }}">CONTACT</a></li>
                                <li class="menu-item "><a href="{{ route('cart') }}">MY CART </a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
        </nav>
        <div class="content-wrap content-row">
            <div class="table">
                <div class="tr">
                    <div class="td icon home-button-wrap"> <a href="{{ route('/') }}" title="home" rel="home">
                            <div class="home-button hide-text custom-icon"
                                style="background-image:url('{{ asset('assets/images/edruptz-white.svg') }}');"></div>
                        </a></div>
                    <div class="td callno">
                        <div class="callus"><span class="cTitle">Email:</span> <span class="phIcon"><i
                                    class="fa fa-phone" aria-hidden="true"></i></span><span
                                class="cTitle">{{ $setting->email }}</span></div>
                    </div>
                    <div class="td connect"><span class="cTitle">Follow us:</span> <a class="iconfb"
                            href="{{ $socialicon->facebook }}" target="_blank"> <i class="fa fa-facebook"
                                aria-hidden="true"></i> </a> <a class="iconinsta" href="{{ $socialicon->instagram }}"
                            target="_blank"> <i class="fa fa-instagram" aria-hidden="true"></i> </a> <a class="icontwit"
                            href="{{ $socialicon->twitter }}" target="_blank"> <i class="fa fa-twitter"
                                aria-hidden="true"></i></a> </div>

                    <div class="td menuOnTopBar">
                        <nav id="menu" role="navigation" class="desktop-menu">
                            <div class="menu-main-menu-personal-container">
                                <ul id="menu-main-menu-personal" class="menu">
                                    <li class="menu-item "><a href="{{ route('courses') }}">COURSES</a></li>
                                    <li class="menu-item "><a href="{{ route('about-edruptz') }}">ABOUT</a></li>
                                    <li class="menu-item "><a href="{{ route('blog') }}">BLOGS</a></li>
                                    <li class="menu-item "><a href="{{ route('contact') }}">CONTACT</a></li>
                                    <li class="menu-item "><a href="{{ route('cart') }}">CART</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    @if (Auth::guard('instructor')->guest() && Auth::guard('student')->guest())
                        <div class="td icon">
                            <button class="noBG" type="button"
                                onClick="window.location.href='{{ route('login') }}'"><i class="fa fa-user-circle"
                                    aria-hidden="true"></i> Login </button>
                        </div>
                        <div class="td icon">
                            <button class="noBG" onClick="window.location.href='{{ route('register') }}'"> <i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i> Register</button>
                        </div>
                    @elseif(Auth::guard('instructor')->user())
                        <div class="afterLogin td icon">
                            <button class="noBG" type="button"
                                onClick="window.location.href='{{ route('instructor-dashboard') }}'"><i
                                    class="fa fa-user-circle" aria-hidden="true"></i> My Account </button>
                        </div>
                    @else
                        <div class="afterLogin td icon">
                            <button class="noBG" type="button"
                                onClick="window.location.href='{{ route('student-dashboard') }}'"><i
                                    class="fa fa-user-circle" aria-hidden="true"></i> My Account </button>
                        </div>
                    @endif
                    <div class="td icon mobile-menu hide-menu pull-right">
                        <div class="mobile-menu-button close">
                            <div class="mobile-menu-icon icon-button"></div>
                            <span>Menu Button</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
