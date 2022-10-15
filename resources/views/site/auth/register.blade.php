@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="accountBanner innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Register</h1>
      <!--<p class="corseCate">Professional Web Developer</p>--> 
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
              <h2 class="lrTitle mb-3">Student Register</h2>
              <form method="post" action="{{route('register-student')}}"  class="form" role="form">
                @csrf
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" name="name" value="{{old('name')}}" placeholder="Full name" type="text">
                  @if($errors->has('name'))
                  <div class="error">{{$errors->first('name')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" name="email" value="{{old('email')}}" placeholder="Email" type="email">
                  @if($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" name="password" value="{{old('password')}}" placeholder="Password" type="password">
                  @if($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Re-password</label>
                  <input class="form-control" name="verify" value="{{old('verify')}}" placeholder="Password (again)" type="password">
                  @if($errors->has('verify'))
                  <div class="error">{{$errors->first('verify')}}</div>
                  @endif </div>
                <div class="form-group">
                  <button class="btn btn-brand" type="submit">Register</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="instructor">
              <h2 class="lrTitle mb-3">Instructor Register</h2>
              <form method="post" action="{{route('register-instructor')}}"  class="form" role="form">
                @csrf
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" name="name" value="{{old('name')}}" placeholder="Full name" type="text">
                  @if($errors->has('name'))
                  <div class="error">{{$errors->first('name')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" name="email" value="{{old('email')}}" placeholder="Email" type="email">
                  @if($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Password</label>
                  <input class="form-control" name="password" value="{{old('password')}}" placeholder="Password" type="password">
                  @if($errors->has('password'))
                  <div class="error">{{$errors->first('password')}}</div>
                  @endif </div>
                <div class="form-group">
                  <label>Re-password</label>
                  <input class="form-control" name="verify" value="{{old('verify')}}" placeholder="Password (again)" type="password">
                  @if($errors->has('verify'))
                  <div class="error">{{$errors->first('verify')}}</div>
                  @endif </div>
                <div class="form-group">
                  <button class="btn btn-brand" type="submit">Register</button>
                </div>
              </form>
            </div>
          </div>
          <div class="pt-4 text-center">Already have an account?. <a href="{{ route('login') }}">Login Here</a> </div>
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