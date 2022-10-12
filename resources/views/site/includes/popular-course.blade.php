@php use App\Models\Course @endphp 
@if($courses->count() > 0)
<section>
  <div class="container">
    <div class="titleWithAllbtn pt-5">
      <h1 class="txtBlue">Most Popular Courses</h1>
      <a class="vallBtn" href="{{ route('courses')}}">View All</a> </div>
    <div class="bestseller owl-theme owl-carousel"> @foreach($courses as $course)
    @php  $avg_rating  = Course::avg_rating($course->id) @endphp
      <div class="card-container">
        <div class="card">
          <div class="cardPic"> <a href="{{ $course->slug }}">
            <picture> @if($course->image) <img src="{{ asset('storage/uploads/course/'.$course->image) }}" alt=""/> @else <img src="{{ asset('assets/images/no-course-image') }}" class="card-img img-fluid"> @endif </picture>
            </a> <a class="categoryBag" href="{{route($course->category->slug)}}">{{ $course->category->name }}</a> </div>
          <div class="card-block">
            <h3 class="card-title"><a class="courseTitle" href="{{ $course->slug }}">{{ $course->name }}</a></h3>
            <a class="courseAuthor" href="{{ $course->instructor->slug }}">{{ $course->instructor->name }}</a>
            <p class="card-text">{{ $course->summary }}</p>
            <ul class="courseSMList">
              <li><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $course->sales->count() }} Student(s)</li>
              <li>@if($avg_rating > 0)
			@for($i = 1; $i<=$avg_rating; $i++)
              <i class="fa fa-star text-warning" aria-hidden="true"></i> @endfor @else   <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> @endif</li>  
              <li>USD {{ $course->amount }}</li>
            </ul>
          </div>
        </div>
      </div>
      @endforeach </div>
  </div>
</section>
@endif