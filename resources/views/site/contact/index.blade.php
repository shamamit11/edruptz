@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Contact us</h1>
    </div>
  </section>
  <section class="contactForm mt-5">
    <div class="container"> @include('site.includes.alert')
      <div class="row gx-5">
        <div class="col-lg-4 col-md-5 col-sm-12">

            <div class="contact-left">
          <h2>Get in Touch</h2>
            <h3>Students and instructors, get in touch if you need any support or additional information. </h3>
          <p class="pt-4">
            {{-- <strong>Teachers & Instructors</strong><br />
            {{ $setting->instructor_email }}<br />
            <br />
           <strong> Students</strong><br />
            {{ $setting->student_email }}<br />
            <br /> --}}
            <strong>Inquiries</strong><br />
            {{ $setting->email }}</p>
          </div>

        </div>
        <div class="col-lg-8 col-md-7 col-sm-12">
          
          
           <div class="formbox ">
               <h2 class="styleTitle">Email us</h2>
            <p class="mt-4 pb-4"><strong>We'd love to hear from you!</strong></p>
          <form method="post" action="{{ route('contact-post') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group ">
                <label>First Name *</label>
                <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control">
                @if($errors->has('first_name'))
                <div class="error">{{$errors->first('first_name')}}</div>
                @endif 
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group ">
                <label>Last Name *</label>
                <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control">
                @if($errors->has('last_name'))
                <div class="error">{{$errors->first('last_name')}}</div>
                @endif </div>
</div>


            </div>
            <div class="row">
              <div class="col-md-6">
                   <div class="form-group ">

                <label>Email *</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control">
                @if($errors->has('email'))
                <div class="error">{{$errors->first('email')}}</div>
                @endif 
              </div>
              </div>
              <div class="col-md-6">
                   <div class="form-group ">
                <label>Phone</label>
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                @if($errors->has('phone'))
                <div class="error">{{$errors->first('phone')}}</div>
                @endif </div>
              </div>
            </div>
               <div class="form-group">
              <label>Country</label>
              <input type="text" name="country" value="{{old('country')}}" class="form-control">
              @if($errors->has('country'))
              <div class="error">{{$errors->first('country')}}</div>
              @endif </div>
            <div class="form-group">
              <label>Message *</label>
              <textarea name="message" cols="30" rows="7" class="form-control"
                                placeholder="Message">{{old('message')}}</textarea>
              @if($errors->has('message'))
              <div class="error">{{$errors->first('message')}}</div>
              @endif </div>
            <button type="submit" class="btn btn-green">Submit Now</button>
          </form>
        </div>
        </div>
      </div>
     
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 