@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>FAQs</h1>
    </div>
  </section>
  <div class="container">
<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12">
      @if($student_faqs)
  <section class="mt-5">
  


      <div class="row gx-5">
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto mb-5"> 
          <div class="formbox ">
          <h2 class="styleTitle">Student FAQs</h2>
          <div class="accordion" id="studentfaq" class="accordion-wrapper">
          @foreach($student_faqs as $faq)
          <div class="card">
            <div class="accordion-item">
              <div class="accordion-header">
                <button class="accordion-button  @if($cnt > 1)  collapsed  @endif" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}" aria-expanded="@if($cnt == 1)  true @else false @endif"> {{ $faq->question }} </button>
              </div>
              <div id="faq{{ $faq->id }}" class="accordion-collapse collapse @if($cnt == 1)  show  @endif" data-bs-parent="#studentfaq">
                <div class="accordion-body"> {!! $faq->answer !!}</div>
              </div>
            </div>
          </div>
          @php $cnt++ @endphp
          @endforeach </div>
        </div>   
       </div>
    </div>

  </section>
  @endif 
  @if($instructor_faqs)

  </div>

  <div class="col-lg-6 col-md-6 col-sm-12">
     <section  class="mt-5">
   
      <div class="row gx-5">
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto mb-5"> 
          <div class="formbox ">
          <h2 class="styleTitle">Instructor FAQs</h2>
          <div class="accordion" id="instructorfaq" class="accordion-wrapper">
          @foreach($instructor_faqs as $faq)
          <div class="card">
            <div class="accordion-item">
              <div class="accordion-header">
                <button class="accordion-button  @if($count > 1)  collapsed  @endif" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}" aria-expanded="@if($count == 1)  true @else false @endif"> {{ $faq->question }} </button>
              </div>
              <div id="faq{{ $faq->id }}" class="accordion-collapse collapse @if($count == 1)  show  @endif" data-bs-parent="#instructorfaq">
                <div class="accordion-body"> {!! $faq->answer !!}</div>
              </div>
            </div>
          </div>
          @php $count++ @endphp
          @endforeach </div>
          </div>
        </div>
    </div>
  
  </section>

  </div>
</div>
  @endif
</div>
</main>
@endsection
@section('footer-scripts')

@endsection 