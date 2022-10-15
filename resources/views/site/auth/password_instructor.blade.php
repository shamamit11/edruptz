@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="accountBanner innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Forgot Password</h1>
    </div>
  </section>
  <section class="mt-5 mb-5">
    <div class="container">
      <div class="loginRegister accountSetting  courseDetails">
        <div class="form-style">
          <div class="tab-content"> @include('site.includes.alert')
            <div class="tab-pane active">
              <h2 class="lrTitle mb-3">Instructor Forgot Password</h2>
              <form method="post" action="{{ route('forgot-password-instructor') }}">
                @csrf
                <div class="form-group pb-0">
                  <input type="email" name="email" placeholder="Email" class="form-control">
                  @if($errors->has('email'))
                  <div class="error">{{$errors->first('email')}}</div>
                  @endif </div>
                <div class="pb-0">
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
@endsection 