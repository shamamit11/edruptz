@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Blogs</h1>
    </div>
  </section>
  <section class="mt-5">
    <div class="container">
      <div class="blogs row mb-5">
        <div class="col-md-8">
          <div class="card mb-3"> 
          @if($row->image)<img src="{{ asset('storage/uploads/blog/'.$row->image)}}" class="card-img-top" alt="{{ $row->name }}">
          @endif
            <div class="card-body">
              <h5 class="card-title">{{ $row->name }}</h5>
              <div class="card-text">{!! $row->description !!}</div>
            </div>
          </div>
          </div>
        @include('site.blog.rt-blog') </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 