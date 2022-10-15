@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="accountBanner innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Login</h1>
    </div>
  </section>
  <section class="mt-5 mb-5">
    <div class="container">
      <div class="loginRegister accountSetting  courseDetails">
        <div class="form-style">
          <ul class="nav nav-tabs" id="loginTab" role="tablist">
            <li class="nav-item"><a href="#student"  class="list-group-item active" data-bs-toggle="list">Student</a></li>
            <li class="nav-item px-1"><a href="#instructor" class="list-group-item" data-bs-toggle="list">Instructor</a></li>
          </ul>
          <div class="tab-content"> @include('site.includes.alert')
            <div class="tab-pane active" id="student">
              <h2 class="lrTitle mb-3">Student Login</h2>
              <form method="post" action="{{ route('login-student') }}">
                @csrf
                <div class="form-group pb-3">
                  <input type="email" name="email" placeholder="Email" class="form-control">
                  @if($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                  @endif </div>
                <div class="form-group pb-3">
                  <input type="password" name="password" placeholder="Password" class="form-control">
                  @if($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                  @endif </div>
                <div class="form-group mb-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <label class="pointer">
                        <input type="checkbox" name="remember_me" value="1">
                        <span class="pl-2 font-weight-bold"> Remember Me</span></label>
                    </div>
                     <div><a href="{{ route('forgot-password-student')  }}"> Forget Password?</a></div>
                  </div>
                </div>
                <div class="pb-2">
                  <button type="submit" class="btn btn-brand w-100 font-weight-bold mt-2">Submit</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="instructor">
              <h2 class="lrTitle mb-3">Instructor Login</h2>
              <form method="post" action="{{ route('login-instructor') }}">
                @csrf
                <div class="form-group pb-3">
                  <input type="email" name="email" placeholder="Email" class="form-control">
                  @if($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                  @endif </div>
                <div class="form-group pb-3">
                  <input type="password" name="password" placeholder="Password" class="form-control">
                  @if($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                  @endif </div>
                <div class="form-group mb-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <label class="pointer">
                        <input type="checkbox" name="remember_me" value="1">
                        <span class="pl-2 font-weight-bold"> Remember Me</span></label>
                    </div>
                     <div><a href="{{ route('forgot-password-instructor')  }}"> Forget Password?</a></div>
                  </div>
                </div>
                <div class="pb-2">
                  <button type="submit" class="btn btn-brand w-100 font-weight-bold mt-2">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="pt-4 text-center"> Get Members Benefit. <a href="{{ route('register') }}">Sign Up</a> </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts') 
<script> 
$('a[data-bs-toggle="list"]').on('shown.bs.tab', function(e) {
    localStorage.setItem('lastTab', $(this).attr('href'));
});
var lastTab = localStorage.getItem('lastTab');
if (lastTab) {
    $('.list-group-item').removeClass('active');
    $('.tab-pane').removeClass('active');
    $('[href="' + lastTab + '"]').addClass('active');
    $('#' + lastTab.substring(1)).addClass('active');
}
</script> 
@endsection 