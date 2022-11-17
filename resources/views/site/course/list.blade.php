@php 
  use App\Models\Course;
@endphp 

@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>Find A Course That Suits You !!</h1>
      <form method="get">
        @csrf
        <div class="input-group">
          <div class="form-outline">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search by Course Name or Category">
          </div>
          <button type="submit" class="btn btn-green ms-2"> <i class="fa fa-search" aria-hidden="true"></i> Search </button>
        </div>
      </form>
    </div>
  </section>
  <section>
    <div class="container  mb-4">
      <div class="titleWithAllbtn pt-5">
         <h2 class="styleTitle">{{$title}}</h2>
         @if(count($age_ranges) > 0)
        <div class="searchFilter dropdown">
          <button class="btn btn-outline-primarys dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"> Filter by </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item">Age</a>
              <ul class="searchInner">
              @foreach($age_ranges as $age_range)
                <li>
                  <div class="form-check">
                   <label class="form-check-label">  <input class="form-check-input" type="radio" value="{{ $age_range }}" name="age" @if($age == $age_range) checked @endif>
               {{ $age_range }} years</label>
                </li>
                @endforeach
              </ul>
            </li>
          </ul>
        </div>
      </div>
      @endif
      <div class="row gx-5"> @if($courses->count() > 0)
        @foreach($courses as $course)
        @php  $avg_rating  = Course::avg_rating($course->id) @endphp
        <div class="col-lg-4 col-md-4 col-sm-12 card-container">
          <div class="card">
            <div class="cardPic"> <a href="{{ $course->slug }}">
              <picture> @if($course->image) <img src="{{ asset('storage/uploads/course/'.$course->image) }}"  class="card-img img-fluid" /> @else <img src="{{ asset('assets/images/no-course-image') }}" class="card-img img-fluid"> @endif </picture>
              </a> <a class="categoryBag" href="{{route($course->category->slug)}}">{{ $course->category->name }}</a> </div>
            <div class="card-block">
              <h3 class="card-title"><a class="courseTitle" href="{{ $course->slug }}">{{ $course->name }}</a></h3>
              <a class="courseAuthor" href="{{ $course->instructor->slug }}">{{ $course->instructor->name }}</a>
              <p class="card-text">{{ $course->summary }}</p>

              
              @if($course->sales->count() > 0 || $avg_rating > 0)
              <ul class="courseSMList">
                <li><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $course->sales->count() }} Student(s)</li>
                <li>@if($avg_rating > 0)
                  @for($i = 1; $i<=$avg_rating; $i++) <i class="fa fa-star text-warning" aria-hidden="true"></i> @endfor @else <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> @endif</li>
                <li>USD {{ $course->amount }}</li>
              </ul>
              @endif
             

            </div>
          </div>
        </div>
        @endforeach
        <div class="align-middle pt-5"> {{ $courses->links('pagination::bootstrap-4') }} </div>
        @else
        <div class="align-middle pt-5">No courses</div>
        @endif </div>
    </div>
  </section>
  @include('site.includes.partner') </main>
@endsection
@section('footer-scripts')
<script>
$().ready( function () {
	$( "input[name='age']" ).click(function() {
		var age = $(this).val();
		var url = '{{ URL::current() }}';
		window.location = url+'?age='+age;
 
	});
} );
</script>
</script>
@endsection 