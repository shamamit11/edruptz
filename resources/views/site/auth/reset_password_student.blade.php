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
          <div class="tab-content"> @include('site.includes.alert')
            <div class="tab-pane active" id="student">
              <h2 class="lrTitle mb-3">Reset password</h2>
              <form method="post" action="{{route('save-password-student')}}"  class="form" role="form">
                @csrf
              <input type="hidden" name="token" value="{{ $token }}">
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
                  <button class="btn btn-brand" type="submit">Reset</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts') 
@endsection 