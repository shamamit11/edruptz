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
        <div class="col-md-8"> @if($blogs->count() > 0)
          @foreach ($blogs as $blog)
          <div class="card mb-3"> 
          @if($blog->image)
          <a href="{{ $blog->slug }}"><img src="{{ asset('storage/uploads/blog/'.$blog->image)}}" class="card-img-top" alt="{{ $blog->name }}"></a>
          @endif
            <div class="card-body">
              <h5 class="card-title"><a href="{{ $blog->slug }}">{{ $blog->name }}</a></h5>
              <p class="card-text">{{ $blog->short_description }}</p>
            </div>
          </div>
            @endforeach
          <div class="align-middle"> {{ $blogs->links('pagination::bootstrap-4') }} </div>
          @endif </div>
        @include('site.blog.rt-blog') </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 