@php use App\Models\Course @endphp 
@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>{{ $row->name}}</h1>
      <p class="corseCate">{{ $row->professional }}</p>
    </div>
  </section>
  <section class="mt-5 mb-5">
    <div class="container">
      <div class="row gx-5">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="profileBox">
            <div class="profilePic"> @if($row->image) <img src="{{asset('/storage/uploads/instructor/'.$row->image)}}"  /> @else <img src="{{asset('assets/images/no-image.jpg')}}"> @endif </div>
            <h3 class="txtBlue mt-4">{{ $row->name}}</h3>
            <?php /*?><p>Lorem ipsum dolor sit amet, consec tetur 
              adipiscing, sed do eiusmod tempor incididunt ut 
              labore.</p><?php */?>
            <!--<ul class="socialList"> 
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>-->
            <p class="studySubj">{{ $row->professional}}</p>
            <!-- <h3 class="txtBlue mt-4">Experience</h3>
            <h4 class="univ">Facebook</h4>
            <p class="studySubj">Full Stack Developer</p>
            <h4 class="univ mt-2">LinkedIn</h4>
            <p class="studySubj">MEAN Stack Developer</p>--> 
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="courseDetails">
            <nav>
              <div class="nav nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-courses" type="button" role="tab" aria-controls="nav-courses" aria-selected="true">Courses</button>
                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="false">About Me</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" aria-controls="nav-reviews" aria-selected="false">Reviews ({{ count($row->reviews)}})</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab"> {!! $row->about_me !!} </div>
              <div class="tab-pane fade  show active" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">
                <div class="row gx-5">
                @if(count($row->courses) > 0)
                 @foreach($row->courses as $course)
                  @php  $avg_rating  = Course::avg_rating($course->id) @endphp
                  <div class="col-lg-6 col-md-6 col-sm-12 card-container">
                  <div class="card">
          <div class="cardPic"> <a href="{{ $course->slug }}">
            <picture> @if($course->image) <img src="{{ asset('storage/uploads/course/'.$course->image) }}" alt="" style="width:100%; height:350px;"/> @else <img src="{{ asset('assets/images/no-course-image') }}" class="card-img img-fluid"> @endif </picture>
            </a> <a class="categoryBag" href="{{route($course->category->slug)}}">{{ $course->category->name }}</a> </div>
          <div class="card-block">
            <h3 class="card-title"><a class="courseTitle" href="{{ $course->slug }}">{{ $course->name }}</a></h3>
            <a class="courseAuthor" href="{{ $course->instructor->slug }}">{{ $course->instructor->name }}</a>
            <p class="card-text">{{ $course->summary }}</p>
            <ul class="courseSMList">
              <li><i class="fa fa-user-circle" aria-hidden="true"></i> {{ $course->sales->count() }} Student(s)</li>
              <li><i class="fa fa-star" aria-hidden="true"></i>  {{  $avg_rating }} Ratings</li>
              <li>USD {{ $course->amount }}</li>
            </ul>
          </div>
        </div>
                  
                  
                    <?php /*?><div class="card">
                        <div class="cardPic"> <a href="#">
                          <picture> <img src="../assets/images/courses.jpg" class="card-img img-fluid"> </picture>
                          </a> <a class="categoryBag" href="#">Course Category</a> </div>
                        <div class="card-block">
                          <h3 class="card-title"><a class="courseTitle" href="#">Design & Development</a></h3>
                          <a class="courseAuthor" href="#">Lorraine Butler</a>
                          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                          <ul class="courseSMList">
                            <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> 1 Student(s)</a></li>
                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> 0 Ratings</a></li>
                            <li><a class="coursePrice" href="#">USD 100</a></li>
                          </ul>
                        </div>
                      </div><?php */?>
                  </div>
                   @endforeach
                   @endif
                </div>
              </div>
              <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
                @if(count($row->reviews) > 0)
                <ul class="reviewList">
                @foreach($row->reviews as $reviews)
                  <li>
                    <div class="reviewPic"> @if($reviews->student->image) <img
                                                src="{{asset('/storage/uploads/student/'.$reviews->student->image)}}"
                                                width="60px" height="60px" /> @else <img
                                                src="{{asset('assets/images/no-image.jpg')}}" width="60px"
                                                height="60px"> @endif </div>
                    <div class="reviewDetails" style="width: 100%;">
                      <div class="titleWithRatings">

 <div class="clearfix">
                        <h4 style="float: left;">{{$reviews->student->name}}</h4>

                        <div class="small-ratings"  style="float: right;">
                        @if($reviews->rating > 0)
                   
      @for($i = 1; $i<=$reviews->rating; $i++)
             <i class="fa fa-star text-warning" aria-hidden="true"></i> @endfor 
             @if($reviews->rating < 5) @for($i = ($reviews->rating+1) ; $i<=5; $i++)  
              <i class="fa fa-star"></i>
              @endfor @endif
              @else
              <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
             @endif</div>

           </div>
                      </div>
                      <p>{{$reviews->description}}</p>
                    </div>
                  </li>
                @endforeach 
                </ul>
                @endif
              </div>
            </div>
          </div>
          <!--<div class="erollandShare">
          <ul class="btnList">
            <li><a class="btnGreen" href="#">Enroll Now</a></li>
            <li><a class="btnBlue" href="#">Share Course</a></li>
          </ul>
        </div>--> 
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 